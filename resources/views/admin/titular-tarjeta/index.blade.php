@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Nombre')</th>
                                    <th>@lang('Correo / Teléfono')</th>
                                    <th>@lang('Dirección')</th>
                                    <th>@lang('Registrado el')</th>
                                    <th>@lang('Acciones')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($titularTarjetas as $titular)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $titular->nombre }}</span>
                                        </td>
                                        <td>
                                            {{ $titular->correo }}<br>{{ $titular->telefono }}
                                        </td>
                                        <td>
                                            {{ $titular->direccion }}
                                        </td>
                                        <td>
                                            {{ showDateTime($titular->created_at) }}<br>
                                            {{ diffForHumans($titular->created_at) }}
                                        </td>
                                        <td>
                                            <a href="{{ route('titular-tarjetas.show', $titular->id) }}" class="btn btn-sm btn-outline--primary">
                                                <i class="las la-eye"></i> @lang('Detalles')
                                            </a>
                                            <a href="{{ route('titular-tarjetas.edit', $titular->id) }}" class="btn btn-sm btn-outline--warning">
                                                <i class="las la-edit"></i> @lang('Editar')
                                            </a>
                                            <form action="{{ route('titular-tarjetas.destroy', $titular->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline--danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar este titular?')">
                                                    <i class="las la-trash"></i> @lang('Eliminar')
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">@lang('No hay titulares disponibles')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($titularTarjetas->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($titularTarjetas) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Buscar por Nombre / Correo" />
@endpush
