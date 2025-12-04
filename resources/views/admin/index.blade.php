<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <x-app-layout>
        <h1>Админ панель</h1>

        <table>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Описание</th>
                    <th>Дата</th>
                    <th>Статус</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <div>
                                <form class="status-form" action="{{route('reports.status.update', $report->id)}}" method="POST">
                                    @method('patch')
                                    @csrf
                                    <select name="status_id" id="status_id" data-current-status="{{ $report->status_id }}">
                                        @foreach($statuses as $status)
                                        <option value="{{$status->id}}" {{$status->id === $report->status_id ? 'selected' : ''}}>
                                            {{$status->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </form> 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-app-layout>
</body>
</html>