var $jq=jQuery.noConflict();$jq(document).ready(function(){$jq('#vsliderdonate').change(function(){switch($jq('#vsliderdonate').val()){case'donate':{$jq('#vsliderdonatebox').show();$jq('#vsliderlink').hide();break}case'link':{$jq('#vsliderdonatebox').hide();$jq('#vsliderlink').show();break}case'nohelp':{$jq('#vsliderdonatebox').hide();$jq('#vsliderlink').hide();break}}})});