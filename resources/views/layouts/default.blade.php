@extends('adminlte::page')

@section('plugins.Sweetalert2', true)

@section('js')
    <script>
        function ConfirmaExclusao(id) {
            swal.fire({
                title: 'Are you sure?', text: "You can add that series again later",
                type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33', confirmButtonText: 'Delete',
                cancelButtonText: 'Nope', closeOnConfirm: false,
            }).then(function(isConfirm){
                if (isConfirm.value){
                    $.get('/'+ @yield('table-delete') +'/'+id+'/destroy', function(data){
                        swal.fire(
                            'Deleted!',
                            'You did it bro!',
                            'success'
                        ).then(function(){
                            window.location.reload();
                        });
                    });
                }
            })
        }
    </script>
@stop