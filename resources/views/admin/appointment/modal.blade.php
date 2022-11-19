  <!-- Modal -->
  <div class="modal fade" id="appModal">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Appointment Details</h4>
                  <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <table class="w-100" id="tblappinfo">
                      <tbody></tbody>
                  </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal" tabindex="-1" id="deleteModal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Delete Record</h5>
                  <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="{{ route('appointments.delete') }}" method="POST">
                  @csrf
                  <div class="modal-body">
                      <p>Are you sure you want to delete the record?</p>
                      <input type="hidden" name="delete_id" id="delete_id">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
