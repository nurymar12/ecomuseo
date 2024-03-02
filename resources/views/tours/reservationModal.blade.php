<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Opcionalmente, también jQuery, Popper.js, y Bootstrap JS para funcionalidad completa -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- Modal -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reservationModalLabel">Reserva de Visita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form action="{{ route('reservations.store') }}" method="POST"> --}}
        <form action="{{ route('visits.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="tour_id" id="tour_id" value="">
            <div class="form-group">
              <label for="number_of_people">Número de personas:</label>
              <input type="number" class="form-control" id="number_of_people" name="number_of_people" required>
              <label for="additional_info">Información Adicional (opcional):</label>
              <textarea class="form-control" id="additional_info" name="additional_info" placeholder="Información de contacto" rows="3" required></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Reservar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
