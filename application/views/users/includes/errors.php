<?php if($this->session->flashdata("errors")):?>
        <div class="modal error-modal"  tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header  bg-danger text-white">
                    <h5 class="modal-title"><?= $this->session->flashdata("error-type");?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-danger">
                    <p>Please fix the following errors:</p>
                    <ul>
<?= $this->session->flashdata("errors");?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
<?php endif; ?>