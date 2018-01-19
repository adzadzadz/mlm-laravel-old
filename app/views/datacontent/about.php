<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>

<div class="container"></div>
<section class="section datacontent-bg1">
	<div class="inner">
		<div class="container">
			<!--<h3 class="hr-left">VISION</h3>

			<p>The phenomenal fusion of the consumers and producers in aspect of mutual sharing of enjoyment of the fruits of producer-consumer relationship enterprise.
			The impregnation of a brand new forceful, self-reliant, and self producing consumer-base community.</p>

			<h3 class="hr-left">MISSION</h3>

			<p>To reawaken and empower the very least person(s) in a community by providing the new potent information of the significance of basic economic self-living individuals. And reeducate and inflare the level of awareness to the economic community the importance of co-existence of consumers and producers enterprise in terms of the inherent social responsibilities and the degree of partaking of the fruits thereof as a matter of right and privilege.
			To collectively consolidate and accredit the various merchants of products and services into a single avenue of enterprise CONSUMER NETWORK SYSTEM, under the guidance of the innovative and dynamic new breed of marketing working principles nowadays and the employment of the state of the art information technology system, to fully consummate the long decades aspiration of producer-consumer (prosumer) business enterprise.</p>-->
		</div>
	</div>
</section>
<div class="container"></div>
<section class="media-section darkbg html5" data-height="380" data-type="video" data-fallback-image="assets/images/content/sharkvideo.jpg" style="min-height: 380px;">
    <div class="video">
        <!-- in order for video to be muted you must add  &amp;api=1&amp;player_id=vimeoplayer1 to the end of the video src
            If you have more than one video, make sure that player_id and id have dif names on each video
    -->
        <video id="video1" muted="" loop="" autoplay="autoplay" preload="auto">
            <source src="http://corpress.html.themeforest.createit.pl/assets/videos/dissolve.mp4" type="video/mp4">
            <source src="http://corpress.html.themeforest.createit.pl/assets/videos/dissolve.webm" type="video/webm">
        </video>
    </div>

    <div class="display-table bg5" style="height: 380px;">
        <div class="inner">
            <!--<div class="container">
		        <h3 class="hr-left">Corporate Background</h3>
                <p>It took consecutive three (3) years of intense and prudent exertion of combined diligent efforts to impregnate a new revolutionary and powerful scheme of network marketing enterprise that collectively stemmed from the more than two (2) decades of expensive experience in the industry of the individuals who ultimately took the bolder step to answer and meet the compelling and recurring challenges hereof  in the form of creating this corporate entity as fervently hoped to be the accessible tool, measure,  and avenue for the ultimate reformation of this wounded and fragile industry. The noblest and sublime inspiration of the incorporators of making this entity into place are those many lives of individuals who are totally dependent already in this industry as their means  of subsistence and in their families as well.</p>
                <p>The business premise and technology system (CNS) being the very core and nucleus of this enterprise has been systematically formed and undergone all the possible elements of evaluation and empirical study of more than one (1) decade past already. </p>
            </div>-->
        </div>
    </div>
</section>

<?= View::make('common.footer')->render(); ?>