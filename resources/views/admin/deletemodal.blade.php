<div class="row justify-content-center">
    <div class="col-auto">
        <div class="modal" tabindex="-1" role="dialog" id="deletemodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="delete_modal_content">
                    <div class="modal-body p-0 pt-2">
                        <div class="row">
                            <div class="col-md-12 text-center mt-2">
                                <h5>Esti sigur ca vrei sa stergi {{ $object }}?</h5>
                            </div>
                        </div>
                        <div class="row col-md-12 justify-content-center p-3">
                                <button type="button" class="btn btn-success col-auto m-1" data-bs-dismiss="modal">Anuleaza</button>
                                <input id="delete-item-button" onclick="deleteItem(event)" type="button" data-id="" class="btn btn-secondary col-auto m-1" value="Sterge">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
