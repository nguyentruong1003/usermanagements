<div id="pageUser" class="title-approve">
    <div class="row">
        {{-- <div class="col-md-6">
            <div class="form-group filter-pagination mb-0">
                <label>{{__('pagination.show')}}</label>
                <select class="form-control page-link" id="boxpagination" wire:model.lazy="perPage" wire:ignore>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                {{__('pagination.record')}}/{{__('pagination.page')}}
            </div>
        </div> --}}
        <div class="col-md-6 d-flex justify-content-end">
            {{ $paginator->appends($_GET)->onEachSide(3)->links('vendor.livewire.bootstrap') }}
        </div>
    </div>
</div>
