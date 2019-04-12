@extends('layouts.app')

@section('title-content')
Auxiliares
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
                    <strong class="card-title">Lista de Auxiliares</strong>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_assistant" title="Añadir auxiliar"><i class="fa fa-plus"></i>Añadir Auxiliar</button>
                </div>
                
                <div class="card-body text-left">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre del auxiliar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(assistant, index) in assistants">
                                <td>
                                    <button type="button" class="btn btn-info" title="Editar Auxiliar" data-toggle="modal" :data-target="'#edit'+assistant.id"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger" title="Eliminar Auxiliar" data-toggle="modal" :data-target="'#del'+assistant.id"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <td>@{{ assistant.name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- Modal de agregación--}}
<div class="modal fade" id="add_assistant" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" @submit.prevent="addAssistant()">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Datos del nuevo auxiliar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class="form-control-label">Nombre del auxiliar</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="code" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="assistant.name">
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
    <div v-for="(assistant, index) in assistants" class="modal fade" :id="'del'+assistant.id" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-danger col-md-6" @click.prevent="deleteAssistant(assistant, index)" data-dismiss="modal">Si</button>
                <button type="button" class="btn btn-success col-md-6" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
{{-- Fin de modal de eliminación --}}
{{-- Modal de edición--}}
<div v-for="(assistant, index) in assistants" class="modal fade" :id="'edit'+assistant.id" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal" @submit.prevent="updateAssistant(assistant, index)">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Editar colorante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class="form-control-label">Nombre del auxiliar</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="code" class="form-control" :class="errors.name ? 'is-invalid' : ''" v-model="assistant.name">
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
                assistants: [],
                assistant: {},
                errors: []
            }
        },
        mounted() {
            axios.get('/assistant').then(response => {
                this.assistants = response.data;
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
            addAssistant(){
                let data = new FormData();
                data.append('name', this.assistant.name);
                axios.post('/assistant', data).then(response => {
                    this.assistants = response.data;
                    this.assistant = {};
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    toastr.error('¡Error!', 'Verifique los datos por favor')
                });
            },
            deleteAssistant(assistant, index){
                axios.delete('/assistant/'+assistant.id).then(() => {
                    this.assistants.splice(index, 1);
                    toastr.success('Operacion exitosa', 'Auxiliar Eliminado');
                }).catch(error => {
                    toastr.error('¡Error!', 'No se pudo eliminar');
                });
            },
            updateAssistant(assistant, index){
                const data = {
                    name: assistant.name
                }
                axios.put('/assistant/'+assistant.id, data).then(response => {
                    const assistants = response.data;
                    this.assistants = assistants;
                    toastr.success('Operacion exitosa', 'Auxiliar Actualizado');
                }).catch(error => {
                    toastr.error('¡Error!', 'No se pudo actualizar');
                });
                
            }
            
        }
        
    });
</script>
@endsection
