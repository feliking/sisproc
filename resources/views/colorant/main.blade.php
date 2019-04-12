@extends('layouts.app')

@section('title-content')
Colorantes
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/lib/datatable/dataTables.bootstrap.min.css') }}">
<style>
.dataTables_filter{
    float: left;
}
</style>
@endsection
@section('content')
<div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Lista de Colorantes</strong>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_colorant" title="Añadir colorante"><i class="fa fa-plus"></i>Añadir Colorante</button>
                </div>
                
                <div class="card-body text-left">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre del colorante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(colorant, index) in colorants">
                                <td>
                                    <button type="button" class="btn btn-info" title="Editar Proveedor" data-toggle="modal" :data-target="'#edit'+colorant.id"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger" title="Eliminar Proveedor" data-toggle="modal" :data-target="'#del'+colorant.id"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <td>@{{ colorant.name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- Modal de agregación--}}
<div class="modal fade" id="add_colorant" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" @submit.prevent="addColorant()">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Datos del nuevo colorante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class="form-control-label">Nombre del colorant</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="code" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="colorant.name">
                                    <small v-if="errors.code" class="form-text text-danger">@{{ errors.name }}</small>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
    {{-- Modal de eliminación de proveedor --}}
    <div v-for="(colorant, index) in colorants" class="modal fade" :id="'del'+colorant.id" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Eliminar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">
                        <i class="fa fa-times"></i>Borrar registro
                   </p>
                   <p>
                       ¿Esta seguro que desea eliminar el registro?
                   </p>
               </div>
               <div class="modal-footer text-center col-md-12">
                <button type="button" class="btn btn-danger col-md-6" @click.prevent="deleteColorant(colorant, index)" data-dismiss="modal">Si</button>
                <button type="button" class="btn btn-success col-md-6" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
{{-- Fin de modal de eliminación --}}
{{-- Modal de edición--}}
<div v-for="(colorant, index) in colorants" class="modal fade" :id="'edit'+colorant.id" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal" @submit.prevent="updateColorant(colorant, index)">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Editar colorante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class="form-control-label">Nombre del colorante</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="code" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="colorant.name">
                                <small v-if="errors.code" class="form-text text-danger">@{{ errors.name }}</small>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal --}}


@endsection

@section('scripts')
<script src="{{ asset('js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/jszip.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/lib/data-table/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/buttons.colVis.min.js') }}"></script>
<script>
    const app = new Vue({
        el: '#app',
        data(){
            return{
                colorants: [],
                colorant: {},
                errors: []
            }
        },
        mounted() {
            axios.get('/colorant').then(response => {
                this.colorants = response.data;
                setTimeout(function(){$('#bootstrap-data-table-export').DataTable(
                    {
                        "dom": '<"text-left"<f>>rtip',
                    //searching: false,
                    //paging: false,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                }
                );}, 0);
            });
        },
        methods:{
            addColorant(){
                let data = new FormData();
                data.append('name', this.colorant.name);
                axios.post('/colorant', data).then(response => {
                    this.colorants = response.data;
                    this.colorant = {};
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    toastr.error('¡Error!', 'Verifique los datos por favor')
                });
            },
            deleteColorant(colorant, index){
                axios.delete('/colorant/'+colorant.id).then(() => {
                    this.colorants.splice(index, 1);
                    toastr.success('Operacion exitosa', 'Colorante Eliminado');
                }).catch(error => {
                    toastr.error('¡Error!', 'No se pudo eliminar');
                });
            },
            updateColorant(colorant, index){
                const data = {
                    name: colorant.name
                }
                axios.put('/colorant/'+colorant.id, data).then(response => {
                    const colorants = response.data;
                    this.colorants = colorants;
                    toastr.success('Operacion exitosa', 'Colorante Actualizado');
                }).catch(error => {
                    toastr.error('¡Error!', 'No se pudo actualizar');
                });
                
            }
            
        }
        
    });
</script>
@endsection
