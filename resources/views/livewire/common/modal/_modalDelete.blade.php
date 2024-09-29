<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">{{__('common.confirm_message.confirm_title')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{__('common.confirm_message.are_you_sure_delete')}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('common.button.cancel')}}</button>
          <button type="button" id="showToastPlacement" class="btn btn-primary" wire:click.prevent="delete()">{{__('common.button.delete')}}</button>
        </div>
      </div>
    </div>
</div>
