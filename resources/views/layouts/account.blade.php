

<div class="b-roi compensate-for-scrollbar">
    <div class="b-roi__items tbl h100p">
        @if(!Auth::user()->userPlan->isEmpty())
      <div class="cll">
            <div class="tbl tbl--xs b-roi__item">
                <div class="cll">
                    <div class="b-roi__subitem b-roi__k">Wallet Balance: </div>
                </div>
                <div class="cll">

                    <div class="b-roi__subitem"><span>
                           @if(empty(Auth::user()->earn))
                          0.0  USDT
                          @else
                            {{number_format(Auth::user()->earn->amount, 2)}} USDT
                            @endif


                        </span></div>
                </div>
            </div>
        </div>
        @if(Auth::user()->userPlanOne->status_deposit == false)
        <div class="cll">
            <div class="tbl tbl--xs b-roi__item">
                <div class="cll">
                    <div class="b-roi__subitemtimer b-roi__k">Time to pay: </div>
                </div>
                <div class="cll">
                    <div class="b-roi__subitemtimer" data-timer-2w=""><span data-timer-2w-d>00d</span> <span data-timer-2w-h>00h</span> <span data-timer-2w-m>00m</span> <span data-timer-2w-s>00s </span></div>
                </div>
            </div>
        </div>
        @endif
        @endif

    </div>
</div>
