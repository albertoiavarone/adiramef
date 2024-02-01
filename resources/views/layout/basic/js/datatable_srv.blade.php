<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>


<script>
function DataTableSrv(id,url,columns,uuid='',order=0,dir='asc',search=false){
    $('#'+id).DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
                 "url": url,
                 "dataType": "json",
                 "type": "POST",
                 "data":{ _token: "{{csrf_token()}}" , "uuid" : uuid }
               },
        "columns": Columns,
        language: {
              url: "{{ asset('plugins/datatables/i18n/'.(session('locale')?session('locale') : app()->getLocale()).'.json') }}"
          },
         "order": [[ order, dir ]],
         "searching": search
    });
}
</script>
