var searchData=
[
  ['rappel_20sur_20le_20fonctionnement_20de_20l_27application',['Rappel sur le fonctionnement de l&apos;application',['../fn.html',1,'DocTechnique']]],
  ['ready',['ready',['../add__perso_8js.html#a8403e101b50431006cc87f39c690240c',1,'ready(function() { $(&quot;.add_perso&quot;).submit(function(event) { s=$(this).serialize();$.ajax({ type:&quot;POST&quot;, data:s, url:&apos;ajax/add_perso.php&apos;, success:function(retour){ auto_load();} });return false;});}):&#160;add_perso.js'],['../attaquer_8js.html#acb2f526d264797dff9d56deab48cf8c1',1,'ready(function(){ $(&quot;.submitf&quot;).click(function(){ var cible=$(&quot;#idCible&quot;).val();var attaquant=$(&quot;#id1&quot;).val();var idUser=$(&quot;#idUser&quot;).val();s=$(&quot;#formId&quot;).serialize();$.ajax({ url:&apos;./ajax/attaque.php&apos;, type:&quot;POST&quot;, data:s, success:function(json) { var x_cible=$(&quot;#card&quot;+cible).offset().left;var y_cible=$(&quot;#card&quot;+cible).offset().top;var x_attaquant=$(&quot;#card&quot;+attaquant).offset().left;var y_attaquant=$(&quot;#card&quot;+attaquant).offset().top;var x=x_cible - x_attaquant;var y=y_cible - y_attaquant;$(&quot;#blast&quot;+attaquant).attr(&quot;hidden&quot;, false);var anim=CSSAnimations.get(&apos;blastAnim&apos;);var anim=CSSAnimations.create({ &apos;0%&apos;:{ transform:&apos;translateX(0px) translateY(0px)&apos; }, &apos;100%&apos;:{ transform:&apos;translateX(&apos;+x+&apos;px) translateY(&apos;+y+&apos;px)&apos; } });$(&quot;#blast&quot;+attaquant).css({ &apos;animation-name&apos;:anim.name, &apos;animation-duration&apos;:&apos;0.5s&apos; });$(&quot;#blast&quot;+attaquant).on(&apos;animationend&apos;, function() { CSSAnimations.remove(anim.name);$(&quot;#blast&quot;+attaquant).attr(&quot;hidden&quot;, true);});if(json.result==&apos;frapper&apos;) { $(&quot;#progress-bar&quot;+json.id).attr(&apos;aria-valuenow&apos;, json.pv);var pv=Number(json.pv);var pv_max=Number($(&quot;#progress-bar&quot;+json.id).attr(&quot;aria-valuemax&quot;));var level=0;level=pv/pv_max;level=level *100;$(&quot;#progress-bar&quot;+json.id).width(level+&apos;%&apos;);} else if(json.result==&apos;Pas possible&apos;) { } else if(json.result==&apos;Tué&apos;) { $(&quot;#progress-bar&quot;+json.id).width(&apos;0%&apos;);$(&quot;#card&quot;+json.id+&quot; img&quot;).attr(&apos;src&apos;, &quot;./images/perso/rip.jpg&quot;);} setTimeout(&quot;location.reload()&quot;, 1 *1000);} });});}):&#160;attaquer.js'],['../sup__perso_8js.html#aff7cf942661c10be775f48b5958e7059',1,'ready(function() { $(&quot;.sup_perso&quot;).submit(function() { s=$(this).serialize();$.ajax({ type:&quot;POST&quot;, data:s, url:&apos;ajax/sup_perso.php&apos;, success:function(retour){ auto_load();} });return false;});}):&#160;sup_perso.js'],['../team_8js.html#aa83382a052fe4af51577f19ee8c9a61a',1,'ready(function() { $(&quot;.add_team&quot;).submit(function() { s=$(this).serialize();$.ajax({ type:&quot;POST&quot;, data:s, url:&apos;ajax/team_ajax.php&apos;, success:function(retour){ auto_load();} });return false;});}):&#160;team.js']]],
  ['recevoirdegats',['recevoirDegats',['../class_personnage.html#a226affce78dca0151e0901896e58f14d',1,'Personnage']]],
  ['recevoirsoins',['recevoirSoins',['../class_personnage.html#acadb61228a3ebdf18318771f954e2ae0',1,'Personnage']]],
  ['recevoirxp',['recevoirXP',['../class_personnage.html#aa64edf7d4c080193213b12643eb05a5d',1,'Personnage']]],
  ['reveil',['reveil',['../class_personnage.html#ab0503fe49e1a5403fe6d43d7d424e3ef',1,'Personnage']]],
  ['rotate',['rotate',['../j_query-_rotate-_plugin_8js.html#ad8a7f90ccace320986b76b89ae173b83',1,'jQuery-Rotate-Plugin.js']]]
];
