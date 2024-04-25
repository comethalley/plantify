<?php

namespace App\Http\Controllers;

use App\Models\InventoryFertilizer;
use App\Models\Log;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\SupplierSeed;
use App\Models\Uom;
use App\Models\User;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\HttpFoundation\Response;
use Endroid\QrCode\Label\Label;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{

    public function index()
    {

        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();
        $supplier = DB::table('suppliers')->where('status', '1')->where('farm_id', $user->farm_id)->orderBy('id', 'DESC')->get();
        $uom = DB::table('uoms')->where('status', '1')->get();
        $seeds = DB::table('plant_infos')->where('status', '1')->get();
        return view("pages.inventory.inventory", ['supplier' => $supplier, 'uom' => $uom, 'seeds' => $seeds]);
    }

    public function getAllSupplier()
    {
        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();
        $supplier = DB::table('suppliers')->where('status', '1')->where('farm_id', $user->farm_id)->orderBy('id', 'DESC')->get();
        $uom = DB::table('uoms')->where('status', '1')->get();
        $seeds = DB::table('seeds')->where('status', '1')->get();
        return view("pages.inventory.suppliertable", ['supplier' => $supplier, 'uom' => $uom, 'seeds' => $seeds]);
    }

    public function getSupplier($id)
    {
        try {
            $supplier = Supplier::where('id', $id)->where('status', 1)->firstOrFail();
            return response()->json($supplier, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Supplier not found'], 404);
        }
    }

    public function getSupplierSeed($id)
    {
        $supplierSeeds = DB::table('supplier_seeds')
            ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_seeds.supplier_id')
            ->leftJoin('uoms', 'uoms.id', '=', 'supplier_seeds.uom_id')
            ->leftJoin('plant_infos', 'plant_infos.id', '=', 'supplier_seeds.seed_id')
            ->select(
                'supplier_seeds.id as suppliers_seedsID',
                'supplier_seeds.image',
                'supplier_seeds.qty as qty',
                'supplier_seeds.qr_code as qr_code',
                'suppliers.id as supplierID',
                'suppliers.name as supplier_name',
                'uoms.id as umoID',
                'uoms.description as umoName',
                'plant_infos.id as seedID',
                'plant_infos.plant_name as seedName',
            )
            ->where('suppliers.id', $id)
            ->orderBy('supplier_seeds.id', 'DESC')
            ->get();

        //return response()->json($supplierSeeds, 200);
        return view("pages.inventory.supplierseed", ['supplierSeeds' => $supplierSeeds]);
    }

    public function generateCode()
    {
        $randomNumber = mt_rand(100000, 999999);

        while (SupplierSeed::where('qr_code', $randomNumber)->exists()) {
            $randomNumber = mt_rand(100000, 999999);
        }

        return $randomNumber;
    }

    public function addSeedSupplier(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => 'required',
            'seed_id' => 'required',
            'uom_id' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                //$input['image'] = $imageName;
            }
            $qrText = $this->generateCode();
            $supplierSeed = SupplierSeed::create([
                'supplier_id' => $data['supplier_id'],
                'image' => $imageName,
                'uom_id' => $data['uom_id'],
                'seed_id' => $data['seed_id'],
                'qty' =>  $data['quantity'],
                'qr_code' => $qrText,
                'status' => 1,
            ]);

            // Log values for debugging
            // Log::info("Seed ID: " . $data['seed_id']);
            // Log::info("Supplier Seed ID: " . $supplierSeed->id);

            $seedID = $supplierSeed->seed_id;
            $seed = DB::table('plant_infos')->where('id', $seedID)->first();
            // dd($seed);

            if ($seed) {
                $seedName = $seed->plant_name;
                $qrCode = $supplierSeed->qr_code;
                $quantity = $supplierSeed->qty;

                $qrLabel = $qrCode . "-" . $seedName . "(" . $quantity . ")";

                $generate = $this->generateqr($qrLabel, $qrCode);

                if (!$generate) {
                    return response()->json(['message' => 'Qr Failed to Generate'], 500);
                }
            } else {
                // Handle the case where $seed is null
                return response()->json(['message' => 'Seed not found'], 404);
            }

            return response()->json(['message' => 'Data successfully saved'], 200);
        } catch (\Exception $e) {
            // Log::error($e);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }



    public function generateqr($qrLabel, $qrCodeNum)
    {

        $label = Label::create($qrLabel);

        $qrCode = QrCode::create($qrCodeNum);

        $writer = new PngWriter;

        $result = $writer->write($qrCode, null, $label);

        // return response($result->getString(), 200, [
        //     'Content-Type' => 'image/png',
        // ]);
        $today = date('Y-m-d');

        $directory = public_path('qrcodes');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // $filename = $qrText . time() . '.png';

        $result->saveToFile($directory . '/' . $qrCodeNum . ".png");

        if ($result) {
            return true;
        } else {
            return false;
        }

        // return redirect('/inventory');
    }

    public function createSupplier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier-name' => 'required|string|max:55',
            'description' => 'required|string|max:100',
            'address' => 'required|string|max:55',
            'contact' => 'required|string|max:55|unique:suppliers,contact',
            'email' => 'required|email|unique:suppliers,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();

        if ($user->farm_id == null) {
            return response()->json(['errors' => 'Please make sure you have a farm assigned to you']);
        }
        Supplier::create([
            'name' => $request['supplier-name'],
            'farm_id' => $user->farm_id,
            'description' => $request['description'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'email' => $request['email'],
            'status' => 1
        ]);

        return response()->json(['message' => 'Supplier created successfully']);
    }

    public function editSupplier(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'supplier-name' => 'required|string|max:55',
            'description' => 'required|string|max:100',
            'address' => 'required|string|max:55',
            'contact' => 'required|string|max:55',
            'email' => 'required|email|', Rule::unique('suppliers')->ignore($supplier->id),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $supplier->update([
            'name' => $request['supplier-name'],
            'description' => $request['description'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'email' => $request['email'],
        ]);

        return response()->json(['message' => 'Supplier edited successfully']);
    }

    public function archiveSupplier(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'supplier-name' => 'required|string|max:55',
            'description' => 'required|string|max:100',
            'address' => 'required|string|max:55',
            'contact' => 'required|string|max:55',
            'email' => 'required|email|', Rule::unique('suppliers')->ignore($supplier->id),
        ]);

        if (!$supplier) {
            return response()->json(['message' => 'The supplier does not exist'], 422);
        }

        $supplier->update([
            'status' => 0,
        ]);

        return response()->json(['message' => 'Supplier Archive successfully']);
    }

    public function editQtySeed(Request $request, $id)
    {
        $supplier_seeds = SupplierSeed::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'qty' => 'required|string|max:55',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $supplier_seeds->update([
            'qty' => $request['qty'],
        ]);

        return response()->json(['message' => 'Qty Updated Successfully']);
    }


    public function downloadQR($qrCode)
    {
        $path = public_path('qrcodes/' . $qrCode);

        if (file_exists($path)) {
            return response()->download($path, $qrCode);
        } else {
            abort(404, 'Image not found');
        }
    }

    //Stocks Function starts here
    public function stocks()
    {
        $stocks = DB::table('stocks')
            ->leftJoin('supplier_seeds', 'supplier_seeds.id', '=', 'stocks.supplier_seeds_id')
            ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_seeds.supplier_id')
            ->leftJoin('uoms', 'uoms.id', '=', 'supplier_seeds.uom_id')
            ->leftJoin('seeds', 'seeds.id', '=', 'supplier_seeds.seed_id')
            ->select(
                'stocks.id as stocksID',
                'stocks.available_seed as available',
                'stocks.used_seed as used',
                'stocks.total as total',
                'supplier_seeds.id as suppliers_seedsID',
                'supplier_seeds.qty as qty',
                'supplier_seeds.qr_code as qr_code',
                'suppliers.id as supplierID',
                'suppliers.name as supplier_name',
                'uoms.id as umoID',
                'uoms.description as umoName',
                'seeds.id as seedID',
                'seeds.name as seedName',
            )
            ->orderBy('stocks.id', 'DESC')
            ->get();
        return view("pages.inventory.stock", ['stocks' => $stocks]);
    }

    public function receivingStock(Request $request)
    {
        $data = $request->validate([
            'qrcode' => 'required|string|max:55',
            'multiplier' => 'required|integer|max:999999'
        ]);

        $qrCode = $data['qrcode'];
        $multiplier = $data['multiplier'];

        try {
            $supplierSeeds = DB::table('supplier_seeds')
                ->where('qr_code', $qrCode)
                ->where('status', '1')
                ->first();

            $supplier_seedsID = $supplierSeeds->id;
            $quantity = $supplierSeeds->qty * $multiplier;

            $record = Stock::where('supplier_seeds_id', $supplier_seedsID)->first();

            if ($record) {
                $totalStocks = $quantity + $record->total;
                $record->update([
                    'total' => $totalStocks,
                ]);

                $updatedRecord = Stock::find($record->id);
                // dd($updatedRecord->toArray());

                $availableQty = $updatedRecord->total - $updatedRecord->used_seed;

                $updatedRecord->update([
                    'available_seed' => $availableQty,
                ]);
                $userID = Auth::user()->id;

                Log::create([
                    'stocks_id' => $record->id,
                    'user_id' => $userID,
                    'category' => "Received",
                    'qty' => $quantity,
                    'status' => 1
                ]);

                return response()->json(['message' => 'Data updated successfully'], 200);
            } else {

                $stocks = Stock::create([
                    'supplier_seeds_id' => $supplier_seedsID,
                    'available_seed' => $quantity,
                    'used_seed' => 0,
                    'total' => $quantity,
                    'status' => 1
                ]);

                $userID = Auth::user()->id;

                Log::create([
                    'stocks_id' => $stocks->id,
                    'user_id' => $userID,
                    'category' => "Received",
                    'qty' => $quantity,
                    'status' => 1
                ]);

                return response()->json(['message' => 'Data created successfully'], 200);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['message' => 'Failed to save data'], 500);
        }
    }

    public function usingStock(Request $request)
    {
        $data = $request->validate([
            'qrcode' => 'required|string|max:55',
            'multiplier' => 'required|integer|max:999999',
            //'mode' => 'required|integer|max:999999'
        ]);

        $qrCode = $data['qrcode'];
        $multiplier = $data['multiplier'];
        //$mode = $data['mode'];

        try {
            $supplierSeeds = DB::table('supplier_seeds')
                ->where('qr_code', $qrCode)
                ->where('status', '1')
                ->first();

            $supplier_seedsID = $supplierSeeds->id;
            $quantity = $multiplier;
            // if ($mode == 1) {
            //     $quantity = $supplierSeeds->qty * $multiplier;
            // } else {
            //     $quantity = $multiplier;
            // }
            $plant_name = DB::table('plant_infos')
                ->where('id', $supplierSeeds->seed_id)
                ->first();

            $record = Stock::where('supplier_seeds_id', $supplier_seedsID)->first();

            if ($record) {
                $totalUsed = $quantity + $record->used_seed;
                $record->update([
                    'used_seed' => $totalUsed,
                ]);

                $updatedRecord = Stock::find($record->id);
                // dd($updatedRecord->toArray());

                $availableQty = $updatedRecord->total - $updatedRecord->used_seed;

                $updatedRecord->update([
                    'available_seed' => $availableQty,
                ]);

                $userID = Auth::user()->id;

                Log::create([
                    'stocks_id' => $record->id,
                    'user_id' => $userID,
                    'category' => "Used",
                    'qty' => $quantity,
                    'status' => 1
                ]);


                return response()->json(['message' => 'Data updated successfully', 'seedName' => $plant_name->plant_name, 'daysHarvest' => $plant_name->days_harvest], 200);
            } else {
                return response()->json(['message' => 'Record Not Found'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['message' => 'Failed to save data' . $e], 500);
        }
    }

    public function logs($id)
    {
        $logs = DB::table('logs')
            ->leftJoin('users', 'users.id', '=', 'logs.user_id')
            ->select(
                'logs.id as logsID',
                'logs.category as category',
                'logs.qty as quantity',
                'logs.created_at as date',
                'logs.status as status',
                'users.id as userID',
                'users.firstname as firstname',
                'users.lastname as lastname',
            )
            ->where('stocks_id', $id)
            ->orderBy('logs.id', 'DESC')
            ->get();

        return view("pages.inventory.logs", ['logs' => $logs]);
    }

    public function voidStock(Request $request)
    {
        $data = $request->validate([
            'logID' => 'required|string|max:55',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $logID = $data['logID'];
        $email = $data['email'];
        $password = $data['password'];

        $credentials = [
            'email' => $email,
            'password' => $password,
            'status' => '1',
        ];

        //Check if the user is existing and authenticated
        if (Auth::attempt($credentials)) {
            $logDetails = Log::where('id', $logID)->where('status', '1')->first();


            //Check whether the log history is made
            if ($logDetails) {

                $stockID = $logDetails->stocks_id;
                $category = $logDetails->category;
                $quantity = $logDetails->qty;

                $stock = Stock::where('id', $stockID)->first();
                // dd($stock);
                if ($category == "Received") {
                    $newQuantity = $stock->available_seed - $quantity;

                    $stock->update([
                        'available_seed' => $newQuantity,
                    ]);
                } else {
                    $availableSeed = $stock->available_seed + $quantity;
                    $newQuantity = $stock->used_seed - $quantity;
                    $stock->update([
                        'available_seed' => $availableSeed,
                        'used_seed' => $newQuantity,
                    ]);
                }

                $logDetails->update(['status' => '0']);

                $updatedRecord = Stock::find($stockID);

                $availableQty = $updatedRecord->available_seed;
                $usedQty = $updatedRecord->used_seed;

                $total = $availableQty + $usedQty;

                $updatedRecord->update([
                    'total' => $total,
                ]);

                return response()->json(['success' => 'Transaction voided successfully'], 200);
            } else {
                return response()->json(['message' => 'Log History Not Found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid Credentials or Inactive User'], 401);
        }
    }

    public function uom()
    {
        $uoms = DB::table('uoms')->where('status', '1')->orderBy('id', 'DESC')->get();

        return view('pages.inventory.uom', ['uoms' => $uoms]);
    }

    public function getUom()
    {
        $uoms = DB::table('uoms')->where('status', '1')->orderBy('id', 'DESC')->get();

        return response()->json(['uoms' => $uoms], 200);
        //return view('pages.inventory.uomtable', ['uoms' => $uoms]);
    }

    public function addUom(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "unitName" => "required|string|max:55"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        $uoms = Uom::create([
            'description' => $data['unitName'],
            'status' => 1
        ]);

        if ($uoms) {
            return response()->json(['message' => 'Measurement added successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to save in the database'], 500);
        }
    }

    public function updateUom(Request $request, $id)
    {
        try {
            $uoms = Uom::findOrFail($id);

            $validator = Validator::make($request->all(), [
                "unitName" => "required|string|max:55"
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $validator->validated();

            $uoms->update([
                'description' => $data['unitName'],
            ]);

            if ($uoms) {
                return response()->json(['message' => 'Measurement Updated Successfully'], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'UOM not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function archiveUom(Request $request, $id)
    {
        try {
            $uoms = Uom::findOrFail($id);

            $uoms->update([
                'status' => 0,
            ]);

            if ($uoms) {
                return response()->json(['message' => 'Measurement Archive Successfully'], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'UOM not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getAllStock()
    {
        $stocks = DB::table('stocks')
            ->leftJoin('supplier_seeds', 'supplier_seeds.id', '=', 'stocks.supplier_seeds_id')
            ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_seeds.supplier_id')
            ->leftJoin('uoms', 'uoms.id', '=', 'supplier_seeds.uom_id')
            ->leftJoin('seeds', 'seeds.id', '=', 'supplier_seeds.seed_id')
            ->select(
                'stocks.id as stocksID',
                'stocks.available_seed as available',
                'stocks.used_seed as used',
                'stocks.total as total',
                'supplier_seeds.id as suppliers_seedsID',
                'supplier_seeds.qty as qty',
                'supplier_seeds.qr_code as qr_code',
                'suppliers.id as supplierID',
                'suppliers.name as supplier_name',
                'uoms.id as umoID',
                'uoms.description as umoName',
                'seeds.id as seedID',
                'seeds.name as seedName',
            )
            ->orderBy('stocks.id', 'DESC')
            ->get();

        return response()->json(['stocks' => $stocks], 200);
    }

    public function fertilizer()
    {
        return view('pages.inventory.fertilizer');
    }

    public function getFertilizer()
    {
        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();

        if ($user->farm_id == null) {
            return response()->json(['errors' => 'Please make sure you have a farm assigned to you']);
        }

        $fertilizers = DB::table('inventory_fertilizers')->where('farm_id', $user->farm_id)->where('status', '1')->orderBy('id', 'DESC')->get();

        return response()->json(['fertilizers' => $fertilizers], 200);
    }

    public function addFertilizer(Request $request)
    {
        $data = $request->validate([
            'fertilizerName' => 'required',
            'fertilizerImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('fertilizerImage')) {
            $image = $request->file('fertilizerImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            //$input['image'] = $imageName;
        }
        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();

        if ($user->farm_id == null) {
            return response()->json(['errors' => 'Please make sure you have a farm assigned to you']);
        }

        $fertilizer = InventoryFertilizer::create([
            'farm_id' => $user->farm_id,
            'fertilizer_name' => $data['fertilizerName'],
            'image' => $imageName,
            'status' => 1,
        ]);

        if ($fertilizer) {
            return response()->json(['message' => 'Fertilizer added successfully'], 200);
        }
    }

    public function updateFertilizer(Request $request, $id)
    {
        try {
            $uoms = InventoryFertilizer::findOrFail($id);

            $validator = Validator::make($request->all(), [
                "fertilizerName" => "required|string|max:55",
                'fertilizerImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            if ($request->hasFile('fertilizerImage')) {
                $image = $request->file('fertilizerImage');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                //$input['image'] = $imageName;
            }


            $data = $validator->validated();

            $uoms->update([
                'fertilizer_name' => $data['fertilizerName'],
                'image' => $imageName,
            ]);

            if ($uoms) {
                return response()->json(['message' => 'Measurement Updated Successfully'], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'UOM not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function archiveFertilizer(Request $request, $id)
    {
        try {
            $uoms = InventoryFertilizer::findOrFail($id);

            $uoms->update([
                'status' => 0
            ]);

            if ($uoms) {
                return response()->json(['message' => 'Measurement Updated Successfully'], 200);
            } else {
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'UOM not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
