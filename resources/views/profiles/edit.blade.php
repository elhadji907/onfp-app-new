@extends('layout.default')

@section('content')
    <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="container-fluid">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">Modifier mon profil</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profiles.update', [$user]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            {{-- <div class="form-group row">
                                <label for="firstname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                <div class="col-md-6">
                                    @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                                </div>
                            </div> --}}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    {!! Form::label('Civilité :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], Auth::user()->civilite ?? old('civilite'), ['placeholder' => '', 'class' => 'form-control-lg', 'id' => 'civilite', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('civilite'))
                                            @foreach ($errors->get('civilite') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="firstname">{{ __('Prénom') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="firstname" type="text"
                                        class="form-control  form-control-sm @error('firstname') is-invalid @enderror"
                                        name="firstname" placeholder="Votre prénom"
                                        value="{{ old('firstname') ?? Auth::user()->firstname }}"
                                        autocomplete="firstname">
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name">{{ __('Nom') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="name" type="text"
                                        class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                        name="name" placeholder="Votre nom"
                                        value="{{ old('name') ?? Auth::user()->name }}" autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="date_naissance">{{ __('Date de naissance') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    @if (Auth::user()->date_naissance !== null)
                                        <input id="date_naissance" type="date"
                                            class="form-control  form-control-sm @error('date_naissance') is-invalid @enderror"
                                            name="date_naissance" placeholder="Votre date de naissance"
                                            value="{{ old('date_naissance') ?? Auth::user()->date_naissance->format('Y-m-d') }}"
                                            autocomplete="date_naissance">
                                    @else
                                        <input id="date_naissance" type="date"
                                            class="form-control  form-control-sm @error('date_naissance') is-invalid @enderror"
                                            name="date_naissance" placeholder="Votre date de naissance"
                                            value="{{ old('date_naissance') ?? Auth::user()->date_naissance }}"
                                            autocomplete="date_naissance">
                                    @endif
                                    @error('date_naissance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lieu_naissance">{{ __('Lieu de naissance') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="lieu_naissance" type="text"
                                        class="form-control  form-control-sm @error('lieu_naissance') is-invalid @enderror"
                                        name="lieu_naissance" placeholder="Votre lieu de naissance"
                                        value="{{ old('lieu_naissance') ?? Auth::user()->lieu_naissance }}"
                                        autocomplete="lieu_naissance">
                                    @error('lieu_naissance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="telephone">{{ __('Téléphone') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="telephone" type="text"
                                        class="form-control  form-control-sm @error('telephone') is-invalid @enderror"
                                        name="telephone" placeholder="Votre numéro de téléphone"
                                        value="{{ old('telephone') ?? Auth::user()->telephone }}"
                                        autocomplete="telephone">
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="fixe">{{ __('Téléphone secondaire') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="fixe" type="text"
                                        class="form-control  form-control-sm @error('fixe') is-invalid @enderror"
                                        name="fixe" placeholder="Votre téléphone secondaire"
                                        value="{{ old('fixe') ?? Auth::user()->fixe }}" autocomplete="fixe">
                                    @error('fixe')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bp">{{ __('BP') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="bp" type="text"
                                        class="form-control  form-control-sm @error('bp') is-invalid @enderror" name="bp"
                                        placeholder="Votre boite postale" value="{{ old('bp') ?? Auth::user()->bp }}"
                                        autocomplete="bp">
                                    @error('bp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fax">{{ __('Fax') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <input id="fax" type="text"
                                        class="form-control  form-control-sm @error('fax') is-invalid @enderror" name="fax"
                                        placeholder="Votre numéro de fax" value="{{ old('fax') ?? Auth::user()->fax }}"
                                        autocomplete="fax">
                                    @error('fax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="adresse">{{ __('Adresse') }}</label>
                                    {{-- <div class="col-md-6"> --}}
                                    <textarea class="form-control  @error('adresse') is-invalid @enderror" name="adresse"
                                        id="adresse" rows="1"
                                        placeholder="Votre adresse complète">{{ old('adresse') ?? Auth::user()->adresse }}</textarea>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {!! Form::label('Situation professionnelle:') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('professionnelle', $professionnelles, Auth::user()->professionnelle->name ?? old('professionnelle'), ['placeholder' => 'Situation professionnelle', 'class' => 'form-control', 'id' => 'professionnelle', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('professionnelle'))
                                            @foreach ($errors->get('professionnelle') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::label('Situation familiale :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('familiale', $familiales, Auth::user()->familiale->name ?? old('familiale'), ['placeholder' => 'Situation familiale', 'class' => 'form-control', 'id' => 'familiale', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('familiale'))
                                            @foreach ($errors->get('familiale') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Télécharger</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="image" value="{{ old('image') }}"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="validatedCustomFile" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="validatedCustomFile">Choisir image de
                                                profil</label>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="pt-2">
                                        <img class="rounded-circle w-25 border border-secondary"
                                            src="{{ asset(Auth::user()->profile->getImage()) }}" width="50"
                                            height="auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="far fa-save">&nbsp;&nbsp;Modifier mon profil</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
