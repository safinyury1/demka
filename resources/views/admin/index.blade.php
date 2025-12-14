<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
   <x-app-layout>
        <h1>Административная панель</h1>

        @if(session('success'))
            <div style="color: green; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="color: red; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Номер</th>
                    <th>Описание</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Изменение статуса</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->user->name }}</td>
                        <td><a href="{{ route('reports.show', $report->id) }}">{{ $report->number }}</a></td>
                        <td>{{ Str::limit($report->description, 100) }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $report->created_at)->translatedFormat('j F Y H:i') }}</td>
                        <td>
                            @if($report->status_id == 1)
                                <span class="status-new">Новое</span>
                            @elseif($report->status_id == 2)
                                <span class="status-confirmed">Подтверждено</span>
                            @elseif($report->status_id == 3)
                                <span class="status-rejected">Отклонено</span>
                            @else
                                {{ $report->status->name ?? 'Неизвестно' }}
                            @endif
                        </td>
                        <td>
                            @if($report->status_id == 1) 
                                <form class="status-form" action="{{ route('reports.status.update', $report->id) }}" method="POST">
                                    @method('patch')
                                    @csrf
                                    <select name="status_id" id="status_id_{{ $report->id }}">
                                        
                                        @foreach ($statuses as $status)
                                            @if($status->id == 2 || $status->id == 3) 
                                                <option value="{{ $status->id }}" {{ $status->id == $report->status_id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </form>
                            @else
                                <select disabled title="Можно изменять только статус 'Новое'">
                                    <option>{{ $report->status->name ?? 'Неизвестно' }}</option>
                                </select>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-app-layout>
</body>
</html>