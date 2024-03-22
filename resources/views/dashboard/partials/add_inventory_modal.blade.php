<div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInventoryModalLabel">Ajouter un état des lieux</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.inventories.add')}}" method="post" id="addInventoryForm"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date d'arrivée</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                               value="{{ old('start_date') }}" required>
                        @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Date de départ</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                               value="{{ old('end_date') }}" required>
                        @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Nom du client</label>
                        <input type="text" class="form-control" id="client_name" name="client_name"
                               value="{{ old('client_name') }}" required>
                        @error('client_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option selected disabled>-- Status --</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>En
                                cours
                            </option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Terminé
                            </option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="client_comment" class="form-label">Commentaire du client</label>
                        <textarea class="form-control" id="client_comment"
                                  name="client_comment">{{ old('client_comment') }}</textarea>
                        @error('client_comment')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="attachment_names" class="form-label">Pièces jointes</label>
                        <input type="file" class="form-control" id="attachment_names" name="attachment_names[]" multiple
                               accept=".pdf,.png,.jpeg,.webp,.jpg">
                        @error('attachment_names')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" value="Ajouter" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
