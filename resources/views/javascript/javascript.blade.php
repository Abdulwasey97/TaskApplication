
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.task-status').change(function () {
            var taskId = $(this).data('task-id');
            var newStatus = $(this).val();
            var messageContainer = $(this).siblings('.message-container');

            // Send AJAX request to update task status
            $.ajax({
                type: 'POST',
                url: '{{ route('update.task.status') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    task_id: taskId,
                    status: newStatus
                },
                success: function (response) {
                    console.log(response);
                    messageContainer.html('<div class="text-green-500">Status updated successfully</div>');
                },
                error: function (error) {
                    console.error(error);
                    messageContainer.html('<div class="text-red-500">Failed to update status</div>');
                }
            });
        });
    });
</script>
