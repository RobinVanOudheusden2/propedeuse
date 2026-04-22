@extends('layouts.app')

@section('content')
    <h1>Mijn collectie</h1>

    <div class="card">
        <h2>Game toevoegen</h2>
        <form method="POST" action="{{ route('collection.store') }}" class="grid">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <label for="game_id">Game</label>
                <select id="game_id" name="game_id" required>
                    <option value="">-- Kies game --</option>
                    @foreach ($games as $game)
                        <option value="{{ $game->id }}" @selected(old('game_id') == $game->id)>{{ $game->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status">Status</label>
                <select id="status" name="status" data-status-select required>
                    <option value="" @selected(old('status') === null)>-- Kies status --</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @selected(old('status') == $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="rating">Rating (1-10)</label>
                <input id="rating" type="number" name="rating" min="1" max="10" data-rating-input value="{{ old('rating') }}">
                <small class="rating-note">Bij status wishlist wordt rating automatisch leeggemaakt.</small>
            </div>
            <div>
                <label for="notes">Notitie</label>
                <input id="notes" name="notes" value="{{ old('notes') }}">
            </div>
            <div>
                <label>&nbsp;</label>
                <button class="btn btn-primary" type="submit">Toevoegen</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2>Overzicht</h2>
        <table>
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Notitie</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    @php $formId = 'collection-form-'.$item->game_id; @endphp
                    <tr>
                        <td>{{ $item->game->title }}</td>
                        <td>
                            <select name="status" data-status-select form="{{ $formId }}">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @selected($item->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="rating" min="1" max="10" data-rating-input form="{{ $formId }}" value="{{ $item->rating }}"></td>
                        <td><input name="notes" form="{{ $formId }}" value="{{ $item->notes }}"></td>
                        <td>
                            <form id="{{ $formId }}" method="POST" action="{{ route('collection.update', $item->game_id) }}" class="inline">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @method('PUT')
                                <button class="btn btn-primary" type="submit">Opslaan</button>
                            </form>
                            <form class="inline" method="POST" action="{{ route('collection.destroy', $item->game_id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Nog geen games in je collectie.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $items->links('vendor.pagination.app') }}
    </div>

    <script>
        function syncRatingState(formElement) {
            const statusSelect = formElement.querySelector('[data-status-select]');
            const ratingInput = formElement.querySelector('[data-rating-input]');

            if (!statusSelect || !ratingInput) {
                return;
            }

            const noStatusSelected = statusSelect.value === '';
            const isWishlist = statusSelect.value === 'wishlist';
            ratingInput.disabled = noStatusSelected || isWishlist;

            if (noStatusSelected || isWishlist) {
                ratingInput.value = '';
            }
        }

        document.querySelectorAll('form').forEach((formElement) => {
            if (!formElement.querySelector('[data-status-select]')) {
                const candidate = document.querySelector('[data-status-select][form="' + formElement.id + '"]');
                if (!candidate) {
                    return;
                }
            }

            const isExternalControlForm = formElement.id && !formElement.querySelector('[data-status-select]');
            if (isExternalControlForm) {
                const statusSelect = document.querySelector('[data-status-select][form="' + formElement.id + '"]');
                const ratingInput = document.querySelector('[data-rating-input][form="' + formElement.id + '"]');
                if (!statusSelect || !ratingInput) {
                    return;
                }

                const syncExternal = () => {
                    const noStatusSelected = statusSelect.value === '';
                    const isWishlist = statusSelect.value === 'wishlist';
                    ratingInput.disabled = noStatusSelected || isWishlist;
                    if (noStatusSelected || isWishlist) {
                        ratingInput.value = '';
                    }
                };

                syncExternal();
                statusSelect.addEventListener('change', syncExternal);
                return;
            }

            syncRatingState(formElement);
            formElement.querySelector('[data-status-select]').addEventListener('change', () => syncRatingState(formElement));
        });
    </script>
@endsection
