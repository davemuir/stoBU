<?php defined('C5_EXECUTE') or die("Access Denied.");
$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
$form = Loader::helper('form');
print $form->textarea($editor->getConversationEditorInputName(), $editor->getConversationEditorMessageBody(), array('class'=>'unbound conversation-editor redactor_conversation_editor_'.$editor->getConversationObject()->getConversationID()));
?>
<script>
$(function() {
    var textarea = $('textarea.unbound.redactor_conversation_editor_<?php echo $editor->getConversationObject()->getConversationID()?>').removeClass('unbound');
    $(textarea).redactor({
        'concrete5': {
            filemanager: <?php echo $fp->canAccessFileManager()?>,
            sitemap: <?php echo $tp->canAccessSitemap()?>,
            lightbox: true
        },
        autoresize: false,
        buttons: [ 'bold','italic','deleted','|','fontcolor','|','link' ],
        callback: function(obj) {
            ConcreteEvent.publish('ConversationRedactorEditorLoaded',obj);
            ConcreteEvent.bind('ConversationSubmitForm',function(){
                obj.setCode("");
    			$('.preview.processing').each(function(){
    				$('input[rel="'+ $(this).attr('rel') +'"]').remove();
    				$(this).remove();
    			});
    			if($('.ccm-conversation-attachment-container').is(':visible')) {
    				$('.ccm-conversation-attachment-container').toggle();
    			}
            });
        }
    });
});
</script>
