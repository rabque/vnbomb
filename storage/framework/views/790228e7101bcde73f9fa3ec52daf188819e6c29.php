<?php $__env->startSection("content"); ?>
<?php if(!empty($sliders)): ?>
    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <section id="top" style="background: url('<?php echo e($slider->image); ?>'); background-size: cover">

            <div class="shader"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-7  page-title white-color">
                        <h1><?php echo e($slider->name); ?></h1>
                        <div class="small-text"><?php echo e($slider->small_text); ?></div>
                        <div class="btn-wrap pad-top-large">
                            <?php if(!empty($slider->url)): ?>
                                <a href="<?php echo e($slider->url); ?>" class="btn btn-sm btn-primary line-btn"> View more <i class="icon-arrow-right-circle icons"></i> </a>
                            <?php endif; ?>
                    </div>
                        </div>
                    <div class="col-sm-6 col-md-5 hidden-xs phone-holder">
                        <div class="secondary-phone"><img src="<?php echo e(asset('img/preview.gif')); ?>" alt=""  ></div>
                    </div>
                </div>
            </div>

        </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php endif; ?>

<section class="pad-large while-alt-bg  text-center" id="feature">
    <div class="container">
        <div class="row">
            <h3 class="light-weight">Feature</h3>
            <p class="pad-sides-15 grey-med margin-bottom-large">Far beyond your typical auth solution.</p>
        </div>
        <div class="row text-center">
            <?php if(!empty($notes)): ?>
                <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="col-sm-6 col-md-4">
                <div class="panel-box">
                    <div class="vertical-align">
                        <h5><?php echo e($note->name); ?></h5>
                        <p class="grey-med"><?php echo e($note->content); ?></p>
                    </div>
                </div>
            </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
        </div>

    </div>
</section>


<section class="pad-large  grey-dark-alt-bg text-center" id="feature">
    <div class="container">
        <div class="row">
            <h3 class="light-weight">Today's Top 5 Players</h3>
        </div>
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
                <table class="player_scores table table-hover">
                    <thead>
                    <tr>
                        <th><span class="wl">Player </span>Name</th>
                        <th><span class="wl">Amount </span>Bet</th>
                        <th><span class="wl">Amount </span>Won</th>
                        <th>Total<span class="wl"> Winnings</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="l_player"><span style="color:white; background-color:#d21a2f">Madness</span></td>
                        <td title="Ƀ5.909802">5,909,802</td>
                        <td title="Ƀ6.918006">6,918,006</td>
                        <td title="Ƀ1.008204">1,008,204</td>
                    </tr>
                    <tr>
                        <td class="l_player"><span style="color:white; background-color:#8a9658">Alta</span></td>
                        <td title="Ƀ11.577568">11,577,568</td>
                        <td title="Ƀ12.332805">12,332,805</td>
                        <td title="Ƀ0.755237">755,237</td>
                    </tr>
                    <tr>
                        <td class="l_player"><span style="color:white; background-color:#8f2537">Give me the fucking money </span></td>
                        <td title="Ƀ11.808649">11,808,649</td>
                        <td title="Ƀ12.276469">12,276,469</td>
                        <td title="Ƀ0.46782">467,820</td>
                    </tr>
                    <tr>
                        <td class="l_player"><span style="color:black; background-color:#b4e36d">okirr</span></td>
                        <td title="Ƀ10.983242">10,983,242</td>
                        <td title="Ƀ11.400029">11,400,029</td>
                        <td title="Ƀ0.416787">416,787</td>
                    </tr>
                    <tr>
                        <td class="l_player"><span style="color:white; background-color:#1ccb84">bla</span></td>
                        <td title="Ƀ7.801906">7,801,906</td>
                        <td title="Ƀ8.104382">8,104,382</td>
                        <td title="Ƀ0.302476">302,476</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>


<section class="pad-large  while-alt-bg text-center" id="feature">
    <div class="container">
        <div class="row">
            <h3 class="light-weight">This Past Week's Top 10 Winning Rounds</h3>
        </div>
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
                <table class="game_scores  table table-hover">
                    <thead>
                    <tr>
                        <th>Board</th>
                        <th>Player</th>
                        <th>Bet</th>
                        <th>Cash Out</th>
                        <th>Win X</th>
                        <th>Next Tile</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div></div>
                        </td>
                        <td>Ernie</td>
                        <td title="Ƀ0.002224">2,224</td>
                        <td title="Ƀ0.424598" class="win">424,598</td>
                        <td>190.92x</td>
                        <td title="Ƀ0.305711" class="win_next">+305,711</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="rr"></div><div class="g"></div><div class="g"></div><div></div><div></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div></div><div class="g"></div><div></div><div class="g"></div><div class="g"></div><div></div><div class="rr"></div><div class="g"></div><div></div><div class="rr"></div><div class="g"></div><div></div><div></div><div class="g"></div></div>
                        </td>
                        <td>Dudley</td>
                        <td title="Ƀ0.033">33,000</td>
                        <td title="Ƀ1.198733" class="win">1,198,733</td>
                        <td>36.33x</td>
                        <td title="Ƀ0.287696" class="win_next">+287,696</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div></div><div class="rr"></div><div></div><div></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div></div><div></div><div></div><div class="g"></div><div></div><div class="g"></div><div class="rr"></div></div>
                        </td>
                        <td>Dudley</td>
                        <td title="Ƀ0.025">25,000</td>
                        <td title="Ƀ0.908113" class="win">908,113</td>
                        <td>36.32x</td>
                        <td title="Ƀ0.217947" class="win_next">+217,947</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div class="g"></div><div></div><div></div><div></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div></div>
                        </td>
                        <td>Ernie</td>
                        <td title="Ƀ0.002224">2,224</td>
                        <td title="Ƀ0.125949" class="win">125,949</td>
                        <td>56.63x</td>
                        <td title="Ƀ0.060456" class="win_next">+60,456</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div></div><div></div><div></div><div></div><div class="rr"></div><div class="g"></div><div class="g"></div><div></div><div class="rr"></div><div class="g"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div class="g"></div><div></div><div></div><div></div><div></div><div></div><div class="g"></div><div class="rr"></div></div>
                        </td>
                        <td>Dudley</td>
                        <td title="Ƀ0.14">140,000</td>
                        <td title="Ƀ1.560237" class="win">1,560,237</td>
                        <td>11.14x</td>
                        <td title="Ƀ0.299566" class="win_next">+299,566</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div></div>
                        </td>
                        <td>Sidney</td>
                        <td title="Ƀ0.01">10,000</td>
                        <td title="Ƀ0.2404" class="win">240,400</td>
                        <td>24.04x</td>
                        <td title="Ƀ0.030102" class="win_next">+30,102</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div></div><div></div><div class="rr"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div></div><div></div><div></div></div>
                        </td>
                        <td>carenko</td>
                        <td title="Ƀ0.000039">39</td>
                        <td title="Ƀ0.001381" class="win">1,381</td>
                        <td>35.41x</td>
                        <td title="Ƀ0.000331" class="win_next">+331</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div></div>
                        </td>
                        <td>Lula</td>
                        <td title="Ƀ0.006746">6,746</td>
                        <td title="Ƀ0.162173" class="win">162,173</td>
                        <td>24.04x</td>
                        <td title="Ƀ0.020307" class="win_next">+20,307</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div></div>
                        </td>
                        <td>Tillman</td>
                        <td title="Ƀ0.004903">4,903</td>
                        <td title="Ƀ0.117868" class="win">117,868</td>
                        <td>24.04x</td>
                        <td title="Ƀ0.014759" class="win_next">+14,759</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div></div><div></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div></div><div class="g"></div><div></div><div class="g"></div><div></div><div class="g"></div><div></div><div class="g"></div><div class="g"></div></div>
                        </td>
                        <td>Byron</td>
                        <td title="Ƀ0.004">4,000</td>
                        <td title="Ƀ0.097172" class="win">97,172</td>
                        <td>24.29x</td>
                        <td title="Ƀ0.034982" class="win_next">+34,982</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>