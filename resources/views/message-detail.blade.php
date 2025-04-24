<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nachrichtendetails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between">
                        <h4>{{ $message->subject }}</h4>
                        <span>{{ $message->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <strong>Von:</strong> {{ $message->name }} ({{ $message->email }})
                    </div>
                    <div>
                        <strong>Nachricht:</strong>
                        <p class="mt-2">{{ $message->message }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('message.history') }}" class="btn btn-primary">Zurück zur Übersicht</a>

                    <form action="{{ route('message.delete', $message->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Löschen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
