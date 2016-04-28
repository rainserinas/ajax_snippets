<!-- MODAL REMOVE -->
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Remove <?=$remove_header?></h4>
        </div>
        <div class="modal-body">
            <p>You are about to remove <code><?=$remove_body?></code>, this procedure is irreversible.</p>
            <p>Do you want to proceed?</p>
        </div>
        <div class="modal-footer">
            <a href="<?=$remove_submit?>" class="btn btn-primary">Yes! I don't need it</a>
            <button class="btn btn-danger" data-dismiss="modal">Oh Wait! Lemme check</button>
        </div>
    </div>
</div>
<!-- END MODAL REMOVE -->