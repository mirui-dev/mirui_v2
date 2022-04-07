<div id="global-noti-parent" class="flex fill-width" style="display: flex;">
    @foreach($notifications as $noti)
    <div id="global-noti-element-{{ $noti['count'] }}" class="global-noti"
        onclick="
            document.getElementById('global-noti-element-{{ $noti['count'] }}').parentNode.removeChild(document.getElementById('global-noti-element-{{ $noti['count'] }}'));
            Livewire.emit('common.notification.dismiss', $noti['count']);
            if(!document.getElementsByClassName('global-noti').length){document.getElementById('global-noti-parent').style.display = 'none';}
        " 
        style="
            @if($noti['color'] && strlen($noti['color']))
                border-bottom-color: {{ $noti['color'] }};
            @endif
        "
    >
    {!! $noti['content'] !!}

    </div>
    @endforeach

    <script>
        // https://laravel-livewire.com/docs/2.x/inline-scripts#introduction
        // https://laravel-livewire.com/docs/2.x/events#in-js
        // https://laravel-livewire.com/docs/2.x/events#browser

        // function dismiss(notiId, delay){
        window.addEventListener('common.notification.push', event => {
            // if(event.detail.color && event.detail.color.length){
            //     document.getElementById(event.detail.id).style.borderBottomColor = event.detail.color;
            // }
            setTimeout(function(){
                if(document.getElementById(event.detail.id)){
                    document.getElementById(event.detail.id).style.animation = ".5s notidismiss";
                    document.getElementById(event.detail.id).style.opacity = 0;
                    setTimeout(function(){
                        if(document.getElementById(event.detail.id)){
                            document.getElementById(event.detail.id).parentNode.removeChild(document.getElementById(event.detail.id));
                            if(!document.getElementsByClassName('global-noti').length){
                                document.getElementById('global-noti-parent').style.display = 'none';
                            }

                            Livewire.emit('common.notification.dismiss', event.detail.count);
                        }
                    },400);
                }
                // console.log(event.detail);
            }, event.detail.timeout);
            // console.log('wow');
        });

    </script>

</div>