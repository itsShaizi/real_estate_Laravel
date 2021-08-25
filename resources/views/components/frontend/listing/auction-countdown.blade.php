<div>
    <div class="timer" 
    x-data="timer('{{ ($auction->start_date.' '.$auction->start_time) }}','{{ ($auction->end_date.' '.$auction->end_time) }}')" 
    x-init="init();">
        
        @if(date('Y-m-d h:i:s',strtotime($auction->start_date.' '.$auction->start_time)) > date('Y-m-d h:i:s'))
            Event Starts in: 
        @elseif(date('Y-m-d h:i:s',strtotime($auction->start_date.' '.$auction->start_time)) <= date('Y-m-d h:i:s')
        && date('Y-m-d h:i:s',strtotime($auction->end_date.' '.$auction->end_time)) >= date('Y-m-d h:i:s')
        )
            Event Ends in:
        @else
            Event Ended
        @endif
        <span x-text="time().days"></span>
        <span x-text="time().hours"></span>
        <span x-text="time().minutes"></span>
        <span x-text="time().seconds"></span>
    </div>
</div>
<script>
    function timer(start,expiry) {
  return {
    expiry: new Date(expiry),
    start: new Date(start),
    remaining:null,
    init() {
      this.setRemaining()
      setInterval(() => {
        this.setRemaining();
      }, 1000);
    },
    setRemaining() {
        if(this.start > new Date().getTime()){
            const diff = this.start - new Date().getTime();
            this.remaining =  parseInt(diff / 1000);
        }else{
            const diff = this.expiry - new Date().getTime();
            this.remaining =  parseInt(diff / 1000);
        }
    },
    days() {
      return {
      	value:(this.remaining / 86400),
        remaining:this.remaining % 86400
      };
    },
    hours() {
      return {
      	value:(this.days().remaining / 3600),
        remaining:this.days().remaining % 3600
      };
    },
    minutes() {
    	return {
      	value:(this.hours().remaining / 60),
        remaining:this.hours().remaining % 60
      };
    },
    seconds() {
    	return {
      	value:(this.minutes().remaining),
      };
    },
    format(value) {
      return ("0" + parseInt(value)).slice(-2)
    },
    time(){
    	return {
      	days:this.format(this.days().value)+'d ',
        hours:this.format(this.hours().value)+'h ',
        minutes:this.format(this.minutes().value)+'m ',
        seconds:this.format(this.seconds().value)+'s',
      }
    },
  }
}

</script>