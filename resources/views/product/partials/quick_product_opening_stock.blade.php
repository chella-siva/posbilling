<style>
  /* Style to ensure stacked modals work */
  .modal.modal-stack {
    z-index: 1060 !important;
  }

  .modal-backdrop.modal-stack {
    z-index: 1055 !important;
  }
</style>

<div class="row" id="quick_product_opening_stock_div">
  <div class="col-sm-12">
    <h4>@lang('lang_v1.add_opening_stock')</h4>
  </div>
  <div class="col-sm-12">
    <table class="table table-condensed table-th-green" id="quick_product_opening_stock_table">
      <thead>
        <tr>
          <th>@lang('sale.location')</th>
          <th>@lang('lang_v1.quantity')</th>
          <th>@lang('purchase.unit_cost_before_tax')</th>
          @if($enable_expiry)
            <th>@lang('lang_v1.expiry_date')</th>
          @endif
          @if($enable_lot)
            <th>@lang('lang_v1.lot_number')</th>
          @endif
          <th>@lang('purchase.subtotal_before_tax')</th>
        </tr>
      </thead>
      <tbody>
        @foreach($locations as $key => $value)
        <tr>
          <td>{{ $value }}</td>
          <td>
            {!! Form::text('opening_stock[' . $key . '][quantity]', 0, ['class' => 'form-control input-sm input_number purchase_quantity', 'required', 'id' => 'quantity_' . $key . '_variationId_subKey']) !!}
            <input type="hidden" name="opening_stock[{{ $key }}][serials]" id="serials_{{ $key }}_variationId_subKey" value="[]" />
            <button type="button" class="btn btn-sm btn-primary open-serial-modal"
              data-location-id="{{ $key }}"
              style="padding: 5px 10px; font-size: 12px;">
              Serial No
            </button>
          </td>
          <td>
            {!! Form::text('opening_stock[' . $key . '][purchase_price]', null, ['class' => 'form-control input-sm input_number unit_price', 'required']) !!}
          </td>
          @if($enable_expiry)
          <td>
            {!! Form::text('opening_stock[' . $key . '][exp_date]', null, ['class' => 'form-control input-sm os_exp_date', 'readonly']) !!}
          </td>
          @endif
          @if($enable_lot)
          <td>
            {!! Form::text('opening_stock[' . $key . '][lot_number]', null, ['class' => 'form-control input-sm']) !!}
          </td>
          @endif
          <td><span class="row_subtotal_before_tax">0</span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- SECOND MODAL -->
<div class="modal fade modal-stack" id="secondModal" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="serialNoModalLabel">Add Serial Numbers</h4>
      </div>
      <div class="modal-body">
        <div class="input-group mb-2">
          <input type="text" id="serial-input" class="form-control" placeholder="Enter Serial No">
          <div class="input-group-append">
            <button class="btn btn-success btn-add-serial" type="button"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <div id="serial-list" class="mt-2">
          <!-- Serial numbers will appear here -->
        </div>
        <small class="text-muted">Press Enter or Click + to add serial numbers. Click (x) to remove.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save-serials">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
var currentLocationId;
var serials = [];

$(document).on('click', '.open-serial-modal', function () {
    currentLocationId = $(this).data('location-id');
    console.log('Opening serial modal for location:', currentLocationId);

    // Load existing serials from hidden input if any
    var serialsJson = $('#serials_' + currentLocationId + '_variationId_subKey').val();
    try {
        serials = JSON.parse(serialsJson);
        if (!Array.isArray(serials)) {
            serials = [];
        }
    } catch(e) {
        serials = [];
    }
    updateSerialDisplay();

    // Lower z-index of first modal and backdrop
    $('#quick_add_product_modal').css('z-index', '1040');
    $('.modal-backdrop').last().css('z-index', '1035');

    // Show second modal
    $('#secondModal').modal('show');
});

// Restore z-index and fix scroll when second modal is closed
$('#secondModal').on('hidden.bs.modal', function () {
    $('#quick_add_product_modal').css('z-index', '');
    $('.modal-backdrop').last().css('z-index', '');

    // If first modal is still open, keep body scroll enabled
    if($('.modal:visible').length > 0) {
        $('body').addClass('modal-open');
    }
});

// Function to update the serial numbers display in the modal
function updateSerialDisplay() {
    var html = '';
    serials.forEach(function(serial, index){
        html += '<span class="badge badge-primary m-1">'+serial+' <a href="#" class="text-white remove-serial" data-index="'+index+'">&times;</a></span>';
    });
    $('#serial-list').html(html);
}

// Remove serial number
$(document).on('click', '.remove-serial', function(e){
    e.preventDefault();
    var index = $(this).data('index');
    serials.splice(index, 1);
    updateSerialDisplay();
});

// Add serial number on input enter or button click
$(document).on('keypress', '#serial-input', function(e) {
    if (e.which == 13) { // Enter key
        e.preventDefault();
        addSerial();
    }
});
$(document).on('click', '.btn-add-serial', function() {
    addSerial();
});

// Add serial to list
function addSerial() {
    var serial = $('#serial-input').val().trim();
    if(serial !== ''){
        serials.push(serial);
        $('#serial-input').val('');
        updateSerialDisplay();
    }
}

// Save serial numbers into hidden input and update quantity field
$(document).on('click', '.save-serials', function() {
    if(serials.length > 0){
        // Update quantity input to the count of serials
        var quantityInput = $('#quantity_' + currentLocationId + '_variationId_subKey');
        quantityInput.val(serials.length);

        // Save serials JSON string into the hidden input
        var serialsInput = $('#serials_' + currentLocationId + '_variationId_subKey');
        serialsInput.val(JSON.stringify(serials));

        // Close modal
        $('#serial-input').blur(); // remove focus to prevent scroll jump
        $('#secondModal').modal('hide');

        Swal.fire({
            icon: 'success',
            title: 'Serial numbers saved locally!',
            timer: 1000,
            showConfirmButton: false
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'No serial numbers',
            text: 'Please add at least one serial number before saving.'
        });
    }
});
</script>
