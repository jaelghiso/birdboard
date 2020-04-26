@if(count($activity->changes['after']) == 1)
    <span class="text-accent font-bold">{{ $activity->user->name }}</span>
    <span class="text-default">updated the {{ key($activity->changes['after']) }} of the project</span>
@else
    <span class="text-accent font-bold">{{ $activity->user->name }}</span>
    <span class="text-default"> updated the project</span>
@endif
