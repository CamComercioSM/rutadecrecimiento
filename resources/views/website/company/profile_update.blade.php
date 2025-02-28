@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')
<div class="c-dashboard">
    @include('website.layouts.header_company')
    <main>
        <div class="container">
            <form class="shadow text-start p-4 mt-4" method="post" action="{{route('company.profile.save')}}" enctype="multipart/form-data">
                
                @csrf

                <div class="row d-flex mt-4">
                    <div class="col-12 col-md-12 mb-4">
                        <h1 class="text-center my-2"><b>Actualizar perfil</b></h1>
                        <hr>
                    </div>
                </div>

                <div class="row d-flex mt-4">
                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label>Describa brevemente su empresa *</label>
                            <textarea name="description" placeholder="Describa brevemente su empresa" required>{{$company->description}}</textarea>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label>Logotipo de su empresa (Se recomienda un formato cuadrado)</label>
                            <input type="file" name="logo" />
                        </div>
                    </div>

                    <div class="col-12 col-md-12 mb-4">
                        <h2 class="my-2"><b>Información de la empresa</b></h2>
                        <hr>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Celular *</label>
                            <input type="text" name="mobile" placeholder="Celular" value="{{$company->mobile}}" required/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Teléfono (opcional)</label>
                            <input type="text" name="telephone" placeholder="Teléfono" value="{{$company->telephone}}"/>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Seleccione un departamento *</label>
                            <select id="department" name="department" required>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}" {{$company->department_id == $department->id ? 'selected' : null}}>{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Seleccione un municipio *</label>
                            <select id="municipality" name="municipality" required>
                                @foreach($municipalities as $municipality)
                                <option value="{{$municipality->id}}" {{$company->municipality_id == $municipality->id ? 'selected' : null}}>{{$municipality->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label>Dirección *</label>
                            <input type="text" name="address" placeholder="Dirección" value="{{$company->address}}" required style="text-transform: uppercase;" />
                        </div>
                    </div>

                </div>

                <div class="row d-flex mt-4">

                    <div class="col-12 col-md-12 mb-4">
                        <h2 class="my-2"><b>Persona de contacto</b></h2>
                        <hr>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Nombre *</label>
                            <input type="text" name="contact_person" value="{{$company->contact_person}}" required  style="text-transform: uppercase;"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Cargo *</label>
                            <select id="list_contacto_position" required onchange="actualizarNombreCargoContacto(this);">
                                <option value="">SELECCIONE UNO</option> 
                                @foreach($listaCargos as $cargo)
                                <option 
                                    @if($cargo->vinculoCargoTITULO == $company->contact_position )    
                                    selected
                                    @endif
                                    value="{{$cargo->vinculoCargoTITULO}}">{{$cargo->vinculoCargoTITULO}}</option>
                                @endforeach
                            </select>
                            <input type="text" id="contact_position" name="contact_position" value="{{$company->contact_position}}" required  style="text-transform: uppercase;display:none;"/>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Email *</label>
                            <input type="text" name="contact_email" placeholder="Email" value="{{$company->contact_email}}" required/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Celular *</label>
                            <input type="text" name="contact_phone" placeholder="Celular" value="{{$company->contact_phone}}" required/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Sexo *</label>
                            <select name="contact_sexo" required>
                                <option value="">SELECCIONE UNO</option>
                                <option value="MASCULINO" @if($company->contact_sexo == 'MASCULINO') selected @endif>MASCULINO</option>
                                <option value="FEMENINO" @if($company->contact_sexo == 'FEMENINO') selected @endif>FEMENINO</option>
                            </select>
                        </div>
                    </div>

                </div>
            
                <div class="row d-flex mt-4">
                    <div class="col-12 col-md-12 mb-4">
                        <h2 class="my-2"><b>Información adicional</b></h2>
                        <hr>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>URL de Sitio Web (Opcional)</label>
                            <input type="text" name="website" placeholder="URL" value="{{$company->website}}"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Instagram (Opcional)</label>
                            <input type="text" name="social_instagram" placeholder="URL" value="{{$company->social_instagram}}"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Facebook (Opcional)</label>
                            <input type="text" name="social_facebook" placeholder="URL" value="{{$company->social_facebook}}"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>LinkedIn (Opcional)</label>
                            <input type="text" name="social_linkedin" placeholder="URL" value="{{$company->social_linkedin}}"/>
                        </div>
                    </div>

                </div>

                <input type="submit" class="button button-primary mt-20 margin-center" value="ACTUALIZAR INFORMACIÓN"/>
            </form>
        </div>
    </main>
</div>
@endsection


@section('js')
<script>

  function actualizarNombreCargoContacto(seleccionable) {
      var cargo = $(seleccionable).find(":selected").val();
      $("#contact_position").val(cargo);
  }

  $('document').ready(function () {
      $('#department').on('change', function () {
          var countryid = $(this).val();
          $.ajax({
              type: 'GET',
              url: '{{route('company.getMunicipios')}}',
              data: 'id=' + countryid,
              dataType: 'json',
              cache: false,
              success: function (result) {
                  var html = '<option value="">Seleccione un municipio</option>';
                  for (var i = 0; i < result.length; i++) {
                      html += '<option value="' + result[i].id + '">' + result[i].name + '</option>';
                  }
                  $('#municipality').html(html);
              },
          });
      })
  })
</script>
@endsection
