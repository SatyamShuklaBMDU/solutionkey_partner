<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusButton = document.getElementById('statusButton');
        const statusInput = document.getElementById('statusInput');
        const isOnline = {{ auth()->guard('admins')->user()->status == 1 ? 'true' : 'false' }};
        function updateStatusUI(online) {
            if (online) {
                statusButton.textContent = 'Set Offline';
                statusButton.classList.add('online-status');
                statusButton.classList.remove('offline-status');
            } else {
                statusButton.textContent = 'Set Online';
                statusButton.classList.remove('online-status');
                statusButton.classList.add('offline-status');
            }
        }
        updateStatusUI(isOnline);
        statusButton.addEventListener('click', function() {
            updateStatusUI(statusInput.value == 1);
        });
    });
</script>
