<script type="text/javascript">
$(document).ready(function() {
  $('body').on('click', '.delete-resource', function(event) {
        event.preventDefault()

    let delete_route = $(this).data('delete-route')
    let row_id = $(this).data('row-id')

    Swal.fire({
        title: "Сигурни ли сте ?",
        text: "Сигурни ли сте, че искате да изтриете този ресурс ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Да, изтрий',
        cancelButtonText: 'Отказ',
        reverseButtons: true
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: delete_route,
          type: 'POST',
          data: {_token: "{{ csrf_token() }}", _method: 'DELETE'}
        })
        .done(function(data) {
          if (data.success) {
            $('#'+row_id).remove()
            Swal.fire("Готово", data.message, "success");
          }
          else {
            Swal.fire("Грешка", data.message, "error");
          }
        })
        .fail(function() {
          Swal.fire("Грешка", data.message, "error");
        })
        .always(function() {
          // console.log("complete");
        })
      }
    })
  })
})
</script>
