@include('templates.header')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Farms</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Districts</a></li>
                                <li class="breadcrumb-item active">Farms</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
            @if(isset($farms) && count($farms) > 0)
                    @foreach($farms as $farm)
                        <div class="col-lg-12">
                            <div class="card" id="tasksList">
                                <div class="card-header border-0">
                                    <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">Farm: &nbsp; {{ $farm->barangay_name }}</h5>

                                        <div class="flex-shrink-0">
                                           <div class="d-flex flex-wrap gap-2">
                                                <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Farm</button>
                                                
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border border-dashed border-end-0 border-start-0">
                                    <form>
                                        <div class="row g-3">
                                            <div class="col-xxl-5 col-sm-12">
                                                <div class="search-box">
                                                    
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-xxl-3 col-sm-4">
                                            <div class="search-box">
                                        <input type="text" class="form-control search bg-light border-light" placeholder="Search for tasks or something...">
                                        <i class="ri-search-line search-icon"></i>
                                        </div>
                                                    
                                            </div>
                                            <!--end col-->

                                            <div class="col-xxl-3 col-sm-4">
    <div class="input-light">
        <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false">
            <div class="choices__inner">
                <select class="form-control choices__input" data-choices="" data-choices-search-false="" name="choices-single-default" id="idStatus" hidden="" tabindex="-1" data-choice="active">
                    <option value="Completed" data-custom-properties="[object Object]">Completed</option>
                </select>
                <div class="choices__list choices__list--single">
                    <div class="choices__item choices__item--selectable" data-item="" data-id="2" data-value="Completed" data-custom-properties="[object Object]" aria-selected="true">Completed</div>
                </div>
            </div>
            <div class="choices__list choices__list--dropdown" aria-expanded="false">
                <div class="choices__list" role="listbox">
                    <div id="choices--idStatus-item-choice-6" class="choices__item choices__item--choice choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="6" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Status</div>
                    <div id="choices--idStatus-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="all" data-select-text="Press to select" data-choice-selectable="" aria-selected="false">All</div>
                    <div id="choices--idStatus-item-choice-2" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Completed" data-select-text="Press to select" data-choice-selectable="" aria-selected="false">Completed</div>
                    <div id="choices--idStatus-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Inprogress" data-select-text="Press to select" data-choice-selectable="" aria-selected="false">Inprogress</div>
                    <div id="choices--idStatus-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="New" data-select-text="Press to select" data-choice-selectable="">New</div>
                    <div id="choices--idStatus-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="Pending" data-select-text="Press to select" data-choice-selectable="">Pending</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end col-->

<div class="col-xxl-1 col-sm-4">
    <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
        <i class="ri-equalizer-fill me-1 align-bottom"></i> Filters
    </button>
</div>

                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end card-body-->
                                <div class="card-body">
    <div class="table-responsive table-card mb-4">
        <table class="table align-middle table-nowrap mb-0" id="tasksTable">
            <thead class="table-light text-muted">
                <tr>
                    <th scope="col" style="width: 40px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                        </div>
                    </th>
                    <th class="sort" data-sort="id">Farm ID</th>
                    <th class="sort" data-sort="farm_name">Farm Name</th>
                    <th class="sort" data-sort="barangay_name">Barangay</th>
                    <th class="sort" data-sort="area">Area</th>
                    <th class="sort" data-sort="address">Address</th>
                    <th class="sort" data-sort="farm_leader">Farm Leader</th>
                    <th class="sort" data-sort="status">Status</th>
                    <th class="sort" data-sort="actions">Actions</th>
                </tr>
            </thead>
            <tbody class="list form-check-all">
            
            <tr>
                
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td class="id">#{{ $farm->id }}</td>
                            <td class="farm_name">{{ $farm->farm_name }}</td>
                            <td class="barangay_name">{{ $farm->barangay_name }}</td>
                            <td class="area">{{ $farm->area }}</td>
                            <td class="address">{{ $farm->address }}</td>
                            <td class="farm_leader">{{ $farm->farm_leader }}</td>
                            <td class="status status-{{ strtolower(str_replace(' ', '-', $farm->status)) }}">{{ $farm->status }}</td>
                            <td class="actions">{{ $farm->farm_leader }}</td>
                            <td>
                               
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">
                            <p>No farms found.</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="noresult" style="display: none">
            <div class="text-center">
                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                <h5 class="mt-2">Sorry! No Result Found</h5>
                <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for your search.</p>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <div class="pagination-wrap hstack gap-2">
            <a class="page-item pagination-prev disabled" href="#">
                Previous
            </a>
            <ul class="pagination listjs-pagination mb-0"></ul>
            <a class="page-item pagination-next" href="#">
                Next
            </a>
        </div>
    </div>
</div>

<style>
.status {
        border-radius: 10px;
        padding: 15px;
        width: 200px;
        text-align: center;
        text-color
    }

    .status-created { background-color: gray; color: black; }
    .status-investigation { background-color: gray; color: white; }
    .status-visiting { background-color: gray; color: red; }
    .status-waiting { background-color: lightblue; color: white; }
    .status-approved { background-color: green; color: white; }
    .status-disapproved { background-color: red; color: white; }
    .status-cancelled { background-color: red; color: white; }
    .status-non-compliant { background-color: red; color: white; }
    </style>
@include('templates.footer')