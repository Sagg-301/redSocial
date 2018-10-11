<!-- main-section -->

	<div class="container section-container <?php if($timeline->hide_cover): ?> no-cover <?php endif; ?>">
		<div class="row">
			<div class="col-md-12">
				<?php if($timeline->type == "user"): ?>
					<?php echo Theme::partial('user-header',compact('user','timeline','liked_pages','joined_groups','followRequests','following_count','followers_count','follow_confirm','user_post','joined_groups_count','guest_events')); ?>

				<?php elseif($timeline->type == "page"): ?>
					<?php echo Theme::partial('page-header',compact('page','timeline')); ?>

				<?php elseif($timeline->type == "group"): ?>
					<?php echo Theme::partial('group-header',compact('timeline','group')); ?>

				<?php elseif($timeline->type == "event"): ?>
					<?php echo Theme::partial('event-header',compact('event','timeline')); ?>

				<?php endif; ?>
			</div>
		</div>
		<div class="row">				 
			<div class="col-md-10">
				
				<div class="row">
					<div class="timeline">
						<div class="col-md-4">
							<?php if($timeline->type == "user"): ?>
							<?php echo Theme::partial('user-leftbar',compact('timeline','user','follow_user_status','own_pages','own_groups','user_events')); ?>

							<?php elseif($timeline->type == "page"): ?>
							<?php echo Theme::partial('page-leftbar',compact('timeline','page','page_members')); ?>

							<?php elseif($timeline->type == "group"): ?>
								<?php echo Theme::partial('group-leftbar',compact('timeline','group','group_members','group_events','ongoing_events','upcoming_events')); ?>

							<?php elseif($timeline->type == "event"): ?>
								<?php echo Theme::partial('event-leftbar',compact('event','timeline')); ?>

							<?php endif; ?>
						</div>

						<!-- Post box on timeline,page,group -->
						<div class="col-md-8">

							<?php if($timeline->type == "user" && $timeline_post == true): ?>
								<?php echo Theme::partial('create-post',compact('timeline','user_post')); ?>

								
							<?php elseif($timeline->type == "page"): ?>
								<?php if(($page->timeline_post_privacy == "only_admins" && $page->is_admin(Auth::user()->id)) || ($page->timeline_post_privacy == "everyone")): ?>
									<?php echo Theme::partial('create-post',compact('timeline','user_post')); ?>

								<?php elseif($page->timeline_post_privacy == "everyone"): ?>	
									<?php echo Theme::partial('create-post',compact('timeline','user_post')); ?>

								<?php endif; ?>
								
							<?php elseif($timeline->type == "group"): ?>						
								<?php if(($group->post_privacy == "only_admins" && $group->is_admin(Auth::user()->id))|| ($group->post_privacy == "members" && Auth::user()->get_group($group->id) == 'approved') || $group->post_privacy == "everyone"): ?>									
									<?php echo Theme::partial('create-post',compact('timeline','user_post','username')); ?>

								<?php endif; ?>

							<?php elseif($timeline->type == "event"): ?>	
								<?php if(($event->timeline_post_privacy == 'only_admins' && $event->is_eventadmin(Auth::user()->id, $event->id)) || ($event->timeline_post_privacy == 'only_guests' && Auth::user()->get_eventuser($event->id))): ?>													
									<?php echo Theme::partial('create-post',compact('timeline','user_post')); ?>								
								<?php endif; ?>
							<?php endif; ?>					

							<div class="timeline-posts">								
								<?php if($user_post == "user" || $user_post == "page" || $user_post == "group"): ?>
									<?php if(count($posts) > 0): ?>
	 									<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>									
	 										<?php echo Theme::partial('post',compact('post','timeline','next_page_url','user')); ?>					
	 									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 									<?php else: ?>
 										<div class="no-posts alert alert-warning"><?php echo e(trans('messages.no_posts')); ?></div>
 									<?php endif; ?>	
 								<?php endif; ?>

 								<?php if($user_post == "event"): ?>
 									<?php if($event->type == 'private' && Auth::user()->get_eventuser($event->id) || $event->type == 'public'): ?>
 										<?php if(count($posts) > 0): ?>	
		 									<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>									
		 										<?php echo Theme::partial('post',compact('post','timeline','next_page_url','user')); ?>					
		 									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	 									<?php else: ?>
	 										<div class="no-posts alert alert-warning"><?php echo e(trans('messages.no_posts')); ?></div>
	 									<?php endif; ?>	
 									<?php else: ?>
 										<div class="no-posts alert alert-warning"><?php echo e(trans('messages.private_posts')); ?></div>
 									<?php endif; ?>	
 								<?php endif; ?>								
							</div>	
						</div>
					</div>
				</div><!-- /row -->
			</div><!-- /col-md-10 -->

			<div class="col-md-2">
				<?php echo Theme::partial('timeline-rightbar'); ?>

			</div>

		</div><!-- /row -->
	</div>
