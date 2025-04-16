@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Lista de Contatos</h4>
                    <a href="{{ route('contatos.create') }}" class="btn btn-primary">Adicionar Contato</a>
                </div>

                <div class="card-body">

                    {{-- Campo de busca integrado --}}
                    <form method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="busca" value="{{ request('busca') }}" class="form-control" placeholder="Buscar por nome">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </form>

                    {{-- Mensagem de sucesso --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @push('scripts')
                    <script>
                        setTimeout(() => {
                            const alert = document.querySelector('.alert-success');
                            if (alert) {
                                alert.classList.remove('show');
                                alert.classList.add('fade');
                                setTimeout(() => alert.remove(), 500);
                            }
                        }, 3000);
                    </script>
                    @endpush

                    {{-- Tabela --}}
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Idade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($contatos as $contato)
                            <tr>
                                <td>{{ ($contatos->currentPage() - 1) * $contatos->perPage() + $loop->iteration }}</td>
                                <td>{{ $contato->nome }}</td>
                                <td>{{ $contato->telefone }}</td>
                                <td>{{ $contato->idade }}</td>
                                <td>
                                    <button class="btn btn-sm btn-secondary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#enderecoModal" 
                                    onclick="verEndereco({{ $contato->id }})"
                                    >
                                        Exibir Endereço
                                    </button>                                      
                                    <a href="{{ route('contatos.edit', $contato->id) }}" class="btn btn-sm btn-success">Editar</a>
                                    <form action="{{ route('contatos.destroy', $contato->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Excluir contato?')" class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum contato encontrado.</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                    <div class="modal fade" id="enderecoModal" tabindex="-1" aria-labelledby="enderecoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content shadow-sm">
                            <div class="modal-header">
                              <h5 class="modal-title" id="enderecoModalLabel">Endereço do Contato</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body" id="conteudoEndereco"></div>                            
                          </div>
                        </div>
                      </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $contatos->appends(['busca' => request('busca')])->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script>
function verEndereco(id) 
{
    document.getElementById('conteudoEndereco').innerHTML = '<p class="text-muted">Carregando endereço...</p>';

    fetch(`/contatos/${id}/endereco`)
        .then(res => res.json())
        .then(data => {
            const html = `
                <div class="mb-2"><strong>CEP:</strong> ${data.cep || '-'}</div>
                <div class="mb-2"><strong>Rua:</strong> ${data.rua || '-'}, Nº ${data.numero || '-'}</div>
                <div class="mb-2"><strong>Complemento:</strong> ${data.complemento || '-'}</div>
                <div class="mb-2"><strong>Cidade:</strong> ${data.cidade || '-'} - ${data.estado || '-'}</div>
            `;
            document.getElementById('conteudoEndereco').innerHTML = html;
        })
        .catch(() => {
            document.getElementById('conteudoEndereco').innerHTML = '<p class="text-danger">Erro ao carregar o endereço.</p>';
        });
}
</script>
@endpush
@endsection
