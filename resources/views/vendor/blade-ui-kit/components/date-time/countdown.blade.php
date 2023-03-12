<div
    x-data="
{
    timer: {
        days: '{{ $days() }}',
        hours: '{{ $hours() }}',
        minutes: '{{ $minutes() }}',
        seconds: '{{ $seconds() }}',
    },
    startCounter: function () {
        let runningCounter = setInterval(() => {
            let countDownDate = new Date({{ $expires->timestamp }} * 1000).getTime();
            let timeDistance = countDownDate - new Date().getTime();

            this.timer.days = this.formatCounter(Math.floor(timeDistance / (1000 * 60 * 60 * 24)));
            this.timer.hours = this.formatCounter(Math.floor((timeDistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
            this.timer.minutes = this.formatCounter(Math.floor((timeDistance % (1000 * 60 * 60)) / (1000 * 60)));
            this.timer.seconds = this.formatCounter(Math.floor((timeDistance % (1000 * 60)) / 1000));
            
            if (timeDistance <= 0) {
                clearInterval(runningCounter);
                setTimeout(function(){
                    Livewire.emit('menu', 4);
                },500);
                return;
            }

        }, 1000);
    },
    formatCounter: function (number) {
        return number.toString().padStart(2, '0');
    }
}
"
    x-init="startCounter()"
    {{ $attributes }}
>
    @if ($slot->isEmpty())
        @if( $days() > 0 )
            <span x-text="timer.days">{{ $days() }}</span> d.
            @endif
            @if( $hours() > 0 )
            <span x-text="timer.hours">{{ $hours() }}</span> h.
            @endif
            @if( $minutes() > 0 )
            <span x-text="timer.minutes">{{ $minutes() }}</span> m.
            @endif
            <span x-text="timer.seconds">{{ $seconds() }} </span> s.
    @else
        {{ $slot }}
    @endif
</div>