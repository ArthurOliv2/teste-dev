@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ isset($contato) ? 'Editar Contato' : 'Adicionar Contato' }}</h5>
                    <a href="{{ route('contatos.index') }}" class="btn btn-danger float-end">Voltar</a>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ isset($contato) ? route('contatos.update', $contato) : route('contatos.store') }}">
                        @csrf
                        @if(isset($contato)) @method('PUT') @endif

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ $contato->nome ?? old('nome') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $contato->telefone ?? old('telefone') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="idade" class="form-label">Idade</label>
                                <input type="number" name="idade" id="idade" class="form-control" value="{{ $contato->idade ?? old('idade') }}" required>
                            </div>
                        </div>

                        <hr>
                        <h6>Endereço</h6>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" name="cep" id="cep" class="form-control" value="{{ $contato->endereco->cep ?? old('cep') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" name="rua" id="rua" class="form-control" value="{{ $contato->endereco->rua ?? old('rua') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" name="numero" id="numero" class="form-control" value="{{ $contato->endereco->numero ?? old('numero') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $contato->endereco->complemento ?? old('complemento') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $contato->endereco->cidade ?? old('cidade') }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" name="estado" id="estado" class="form-control" value="{{ $contato->endereco->estado ?? old('estado') }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ isset($contato) ? 'Atualizar' : 'Salvar' }}
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script src="https://unpkg.com/imask"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Máscara telefone
        const telefoneInput = document.getElementById('telefone');
        if (telefoneInput) {
            IMask(telefoneInput, {
                mask: '(00) 00000-0000'
            });
        }

        // Máscara CEP
        const cepInput = document.getElementById('cep');
        if (cepInput) {
            IMask(cepInput, {
                mask: '00000-000'
            });
        }
    });
</script>
@endpush
@endsection
