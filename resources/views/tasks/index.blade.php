@php
    use Illuminate\Support\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="/assets/css/index.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tasks</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
        </div>

        @if (session('success'))
            <div class="muted" role="status">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('tasks.index') }}" class="filters" style="margin-bottom: 1rem;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title..." />
            <select name="status">
                <option value="">All Statuses</option>
                @foreach (['pending' => 'Pending', 'in-progress' => 'In Progress', 'completed' => 'Completed'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <button class="btn" type="submit">Apply</button>
            <a class="btn" href="{{ route('tasks.index') }}">Reset</a>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($tasks as $task)
                @php
                    $isOverdue = $task->due_date && \Illuminate\Support\Carbon::parse($task->due_date)->isPast() && $task->status !== 'completed';
                @endphp
                <tr>
                    <td class="{{ $isOverdue ? 'overdue' : '' }}">{{ $task->title }}</td>
                    <td>
                        <span class="status status-{{ str_replace(' ', '-', $task->status) }}">{{ ucfirst(str_replace('-', ' ', $task->status)) }}</span>
                    </td>
                    <td class="{{ $isOverdue ? 'overdue' : 'muted' }}">{{ $task->due_date ? \Illuminate\Support\Carbon::parse($task->due_date)->toFormattedDateString() : '—' }}</td>
                    <td>
                        <div class="actions">
                            <a class="btn" href="{{ route('tasks.edit', $task) }}">Edit</a>
                            <form class="inline" method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="muted">No tasks found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        
    </div>
</body>
</html>


