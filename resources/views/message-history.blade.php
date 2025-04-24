<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nachrichtenverlauf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Nachrichtenverlauf</h2>
    <a href="/" class="btn btn-primary mb-3">Zurück zum Formular</a>

    <!-- Suchformular -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('message.history') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Nach Name oder Betreff suchen" value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-4">
                    <select name="sort" class="form-select">
                        <option value="created_at" {{ ($sortField ?? '') == 'created_at' ? 'selected' : '' }}>Datum</option>
                        <option value="name" {{ ($sortField ?? '') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="subject" {{ ($sortField ?? '') == 'subject' ? 'selected' : '' }}>Betreff</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="direction" class="form-select">
                        <option value="desc" {{ ($sortDirection ?? '') == 'desc' ? 'selected' : '' }}>Absteigend</option>
                        <option value="asc" {{ ($sortDirection ?? '') == 'asc' ? 'selected' : '' }}>Aufsteigend</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Filtern</button>
                    <a href="{{ route('message.history') }}" class="btn btn-secondary">Zurücksetzen</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Nachrichtenliste -->
    @if(count($messages) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Betreff</th>
                    <th>Datum</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('message.show', $message->id) }}" class="btn btn-sm btn-info">Details</a>
                            <form action="{{ route('message.delete', $message->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Löschen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $messages->links() }}
        </div>
    @else
        <div class="alert alert-info">Keine Nachrichten gefunden.</div>
    @endif
</div>
</body>
</html>
