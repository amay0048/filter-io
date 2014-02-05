.component-feed .feedItem .content.action .attachment_big_photo<?php
  $action = $this->action;
  $actionFormat = $this->actionFormat;
  if (!$action || !$actionFormat){
    return ;
  }


?>



<li data-id="<?php echo $actionFormat['id'];?>" class="feedItem">

  <div class="content menu" style="display: none;">
    <?php if (!empty($actionFormat['canDelete'])):?>
      <a href="javascript:void(0);" class="btn btn-danger wall-event we-remove" data-url="<?php echo $actionFormat['deleteUrl']?>" data-message="<?php echo $this->translate('Are you sure that you want to delete this activity item and all of its comments? This action cannot be undone.');?>"><?php echo $this->translate('Delete');?></a>
    <?php endif;?>
    <?php if (!empty($actionFormat['canReport'])):?>
      <a href="<?php echo $actionFormat['reportUrl'];?>" class="btn"><?php echo $this->translate('WALL_MENU_Report Abuse');?></a>
    <?php endif;?>
    <?php if (!empty($actionFormat['canMute'])):?>
      <a href="javascript:void(0);" class="btn wall-event we-removeTag" data-url="<?php echo $actionFormat['removeTagUrl'];?>"><?php echo $this->translate('WALL_MENU_Remove Tag');?></a>
    <?php endif;?>
    <a href="javascript:void(0);" class="btn btn-primary wall-event we-hideMenu" ><?php echo $this->translate('Cancel');?></a>
  </div>

  <div class="content action <?php if (strlen($actionFormat['richContent']['photo']['full']) || !empty($actionFormat['attachments']) && count($actionFormat['attachments'] === 1)) : echo 'photo'; endif;?>">
    <a href="javascript:void(0);" class="feedItemMenu icon-cog ui-link wall-event we-showMenu"></a>
      
      <?php if (!empty($actionFormat['richContent'])):?>
        <div class="attachment_big_photo">
          <a href="<?php echo $actionFormat['richContent']['href'];?>">
            <img src="<?php echo $actionFormat['richContent']['photo']['full'];?>" alt=""/>
          </a>
          </div>
      <?php endif;?>
      
   <?php if (!empty($actionFormat['attachments'])): ?>
    <div class="attachment_big_photo">
      <a href="<?php echo $actionFormat['attachments'][0]['subject']['href'];?>">
        <img src="<?php echo $actionFormat['attachments'][0]['photo']['normal']?>" alt=""/>
      </a>
    </div>
    <?php endif;?>
      
    <div class="thumbnail">
      <a href="<?php echo $actionFormat['subject']['href'];?>">
        <img src="<?php echo $actionFormat['photo']?>" alt=""/>
      </a>
    </div>

    <!--div class="poster">
      <span class="date">
        <?php echo $actionFormat['creation_date'];?>
        <?php if (!empty($actionFormat['checkin'])):?>
          <?php echo $actionFormat['checkin']['prefix']; ?>
          <a href="<?php echo $actionFormat['checkin']['href']; ?>"><?php echo $actionFormat['checkin']['title']; ?></a>
        <?php endif;?>
      </span>
    </div-->
    <div class="body">

      <?php echo $actionFormat['title'];?>

      <?php if (!empty($actionFormat['richContent'])):?>
          <div class="attachment">
            <div class="title"><a href="<?php echo $actionFormat['richContent']['href'];?>"><?php echo $actionFormat['richContent']['title'];?></a></div>
            <?php if (!empty($actionFormat['richContent']['short_desc'])):?>
              <div class="description"><?php echo $actionFormat['richContent']['short_desc'];?></div>
            <?php endif;?>
          </div>
        <?php endif;?>


      <?php
  /**
   * Display title and description of the link
    */
  ?>
      <?php if (!empty($actionFormat['attachments'])):?>
        <?php if (count($actionFormat['attachments']) == 1):?>
          <?php
          $attachment  = $actionFormat['attachments'][0];
          ?>
          <!--div class="attachment_photo"-->
            <?php if (!empty($attachment['title'])):?>
              <div class="title"><a href="<?php echo $attachment['href'];?>"><?php echo $attachment['title'];?></a></div>
            <?php endif;?>
            <?php if (!empty($attachment['description'])):?>
              <!--div class="description"><?php echo $attachment['description'];?></div-->
            <?php endif;?>
          <!-- /div -->
        <?php endif;?>
      <?php endif;?>
    </div>

    <!--div style="clear: both;"></div-->


  <?php if (!empty($actionFormat['attachments'])):?>
    <?php if (count($actionFormat['attachments']) == 1):?>
      <?php
      $attachment  = $actionFormat['attachments'][0];
      ?>
      <!--div class="attachment_small_photo">
        <?php if (!empty($attachment['photo'])):?>
          <a href="<?php echo $attachment['href'];?>">
            <img src="<?php echo $attachment['photo']['full'];?>" alt=""/>
          </a>
        <?php endif;?>
      </div-->
    <?php else :?>
      <?php $imgCount = count($actionFormat['attachments']) ?>
      <div class="<?php if($imgCount < 6){ ?>thumbs_container<?php }?>">
          <ul class="attachment_thumbs not-inited">
            <?php if($imgCount > 5) {?>
        <?php foreach ($actionFormat['attachments'] as $attachment): ?>
        <li>
          <?php if (!$attachment['is_album'] && !empty($attachment['title'])): ?>
            <div class="title"><a href="<?php echo $attachment['href'];?>"><?php echo $attachment['title'];?></a></div>
          <?php endif;?>
          <a data-subject="<?php echo @$attachment['href']; ?>" data-id="<?php echo @$attachment['id']; ?>" data-itemtype="<?php echo @$attachment['type']; ?>" title="<?php echo @$attachment['title']; ?>" href="<?php echo $attachment['photo']['full'];?>" class="<?php if ($attachment['is_album']):?>photoviewer<?php endif;?>"><img profile-src="<?php echo $attachment['photo']['profile'];?>"  normal-src="<?php echo $attachment['photo']['normal'];?>" src="<?php echo $attachment['photo']['normal'];?>" alt="" /></a>
        </li>
        <?php endforeach;?>
            <?php } else {?>
            <?php foreach ($actionFormat['attachments'] as $attachment): ?>
            <li>
              <?php if (!$attachment['is_album'] && !empty($attachment['title'])): ?>
                <div class="title"><a href="<?php echo $attachment['href'];?>"><?php echo $attachment['title'];?></a></div>
              <?php endif;?>
              <a data-subject="<?php echo @$attachment['href']; ?>" data-id="<?php echo @$attachment['id']; ?>" data-itemtype="<?php echo @$attachment['type']; ?>" title="<?php echo @$attachment['title']; ?>" href="<?php echo $attachment['photo']['full'];?>" class="<?php if ($attachment['is_album']):?>photoviewer<?php endif;?>"><img profile-src="<?php echo $attachment['photo']['full'];?>"  normal-src="<?php echo $attachment['photo']['profile'];?>" src="<?php echo $attachment['photo']['profile'];?>" alt="" /></a>
            </li>
            <?php endforeach;?>
            <?php }?>
      </ul>
      </div>
    <?php endif;?>
  <?php endif;?>


    <!--div style="clear: both;"></div-->


    <?php if (!empty($actionFormat['commentable']) /*&& (!empty($actionFormat['like_count']) || !empty($actionFormat['comment_count']))*/) : ?>
      <div class="actions">
        <?php echo $actionFormat['creation_date'];?>
        <a href="<?php echo $actionFormat['href'];?>">
            <span class="icon icon-thumbs-up"></span> <span class="text"><?php echo $actionFormat['like_count'];?></span>
            <span class="icon icon-comments"></span> <span class="text"><?php echo $actionFormat['comment_count'];?></span>
        </a>
      </div>
    <?php endif;?>

  </div>
</li>

