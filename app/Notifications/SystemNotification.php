<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Bus\Queueable;
use App\Enums\NotificationType;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use AvtoDev\FirebaseNotificationsChannel\FcmMessage;
use AvtoDev\FirebaseNotificationsChannel\FcmChannel;

/**
 * Class SystemNotification
 *
 * @package App\Notifications
 * @date 2019-07-16
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class SystemNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\SystemNotification
     */
    private $SystemNotification;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\SystemNotification $SystemNotification
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function __construct(\App\Models\SystemNotification $SystemNotification)
    {
        $this->SystemNotification = $SystemNotification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param User|Driver $notifiable
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function via($notifiable): array
    {
        $via = ['database'];
        if ($notifiable->firebase_token !== NULL) {
            $via[] = FcmChannel::class;
        }
        if ($notifiable instanceof User) {
            if ($notifiable->isCorporate()) {
                $via[] = 'mail';
            }
        } else {
            $via[] = 'mail';
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param User|Driver $notifiable
     * @return MailMessage
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('GlobalIMD | :notification_title', [
                'notification_title' => $notifiable->locale === 'ar' ? $this->SystemNotification->title_ar : $this->SystemNotification->title_en,
            ], $notifiable->locale))
            ->line(__('Hello :name.', [
                'name' => $notifiable->name,
            ], $notifiable->locale))
            ->line($notifiable->locale === 'ar' ? $this->SystemNotification->body_ar : $this->SystemNotification->body_en)
            ->line(__('Thank you for making Jordan greener!', [], $notifiable->locale));
    }

    /**
     * Get the FCM representation of the notification
     *
     * @param User|Driver $notifiable
     * @return FcmMessage
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function toFcm($notifiable): FcmMessage
    {
        return (new FcmMessage)
            ->setTitle($notifiable->locale === 'ar' ? $this->SystemNotification->title_ar : $this->SystemNotification->title_en)
            ->setBody($notifiable->locale === 'ar' ? $this->SystemNotification->body_ar : $this->SystemNotification->title_en)
            ->setData([
                'notification_type' => NotificationType::SYSTEM_NOTIFICATION,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param User|Driver $notifiable
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function toArray($notifiable): array
    {
        return [
            'system_notification_id' => $this->SystemNotification->id,
            'notification_type' => NotificationType::SYSTEM_NOTIFICATION,
            'locale' => $notifiable->locale,
        ];
    }
}
