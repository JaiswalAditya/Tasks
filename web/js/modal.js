<script>
    $(function ()){
        $('#modalbutton').click(function ()){
            $('#modal').modal('show'){
                .find('#modalcontent')
                .load($(this).attr('value'));
            }
        }
    }
</script>