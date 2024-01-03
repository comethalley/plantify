<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Supplier;
use App\Models\SupplierSeed;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\HttpFoundation\Response;
use Endroid\QrCode\Label\Label;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InventoryController extends Controller
{

    public function index()
    {

        $supplier = DB::table('suppliers')->where('status', '1')->orderBy('id', 'DESC')->get();
        $uom = DB::table('uoms')->where('status', '1')->get();
        $seeds = DB::table('seeds')->where('status', '1')->get();
        return view("pages.inventory.inventory", ['supplier' => $supplier, 'uom' => $uom, 'seeds' => $seeds]);
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
            ->leftJoin('seeds', 'seeds.id', '=', 'supplier_seeds.seed_id')
            ->select(
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
            'supplier_id' => 'required|string|max:55',
            'seed_id' => 'required|string|max:55',
            'uom_id' => 'required|string|max:55',
            'quantity' => 'required|string|max:55',
        ]);

        $qrText = $this->generateCode();

        try {
            $supplierSeed = SupplierSeed::create([
                'supplier_id' => $data['supplier_id'],
                'uom_id' => $data['uom_id'],
                'seed_id' => $data['seed_id'],
                'qty' =>  $data['quantity'],
                'qr_code' => $qrText,
                'status' => 1,
            ]);

            $qrText = $supplierSeed->qr_code;

            $this->generateqr($qrText);

            return response()->json(['message' => 'Data successfully saved'], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Failed to save data'], 500);
        }
    }


    public function generateqr($qrText)
    {

        // $data = $request->validate([
        //     'qr-code' => 'required|string|max:55'
        // ]);

        $label = Label::create($qrText);

        $qrCode = QrCode::create($qrText);

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

        $result->saveToFile($directory . '/' . $qrText . ".png");

        // return redirect('/inventory');
    }

    public function createSupplier(Request $request)
    {
        $data = $request->validate([
            'supplier-name' => 'required|string|max:55',
            'description' => 'required|string|max:55',
            'address' => 'required|string|max:55',
            'contact' => 'required|string|max:55',
            'email' => 'required|email|unique:suppliers,email'
        ]);

        // if ($validator->fails()) {
        //     return redirect('/inventory')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        Supplier::create([
            'name' => $data['supplier-name'],
            'description' => $data['description'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'status' => 1
        ]);

        return redirect('/inventory');
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
        ]);

        $qrCode = $data['qrcode'];

        try {
            $supplierSeeds = DB::table('supplier_seeds')
                ->where('qr_code', $qrCode)
                ->where('status', '1')
                ->first();

            $supplier_seedsID = $supplierSeeds->id;
            $quantity = $supplierSeeds->qty;

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

                return response()->json(['message' => 'Data updated successfully'], 200);
            } else {
                Stock::create([
                    'supplier_seeds_id' => $supplier_seedsID,
                    'available_seed' => $quantity,
                    'used_seed' => 0,
                    'total' => $quantity,
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
        ]);

        $qrCode = $data['qrcode'];

        try {
            $supplierSeeds = DB::table('supplier_seeds')
                ->where('qr_code', $qrCode)
                ->where('status', '1')
                ->first();

            $supplier_seedsID = $supplierSeeds->id;
            $quantity = $supplierSeeds->qty;

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

                return response()->json(['message' => 'Data updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Record Not Found'], 500);
            }
        } catch (ModelNotFoundException $e) {

            return response()->json(['message' => 'Failed to save data'], 500);
        }
    }
}
