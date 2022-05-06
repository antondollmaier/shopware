<?php declare(strict_types=1);

namespace Shopware\Core\Content\MailTemplate\Service\Event;

use Monolog\Logger;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Event\BusinessEventInterface;
use Shopware\Core\Framework\Event\EventData\ArrayType;
use Shopware\Core\Framework\Event\EventData\EventDataCollection;
use Shopware\Core\Framework\Event\EventData\ScalarValueType;
use Shopware\Core\Framework\Log\LogAware;
use Symfony\Contracts\EventDispatcher\Event;

class MailBeforeValidateEvent extends Event implements BusinessEventInterface, LogAware
{
    public const EVENT_NAME = 'mail.before.send';

    /**
     * @var array
     */
    private $data;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var array
     */
    private $templateData;

    /**
     * @internal
     */
    public function __construct(array $data, Context $context, array $templateData = [])
    {
        $this->data = $data;
        $this->context = $context;
        $this->templateData = $templateData;
    }

    public static function getAvailableData(): EventDataCollection
    {
        return (new EventDataCollection())
            ->add('data', new ArrayType(new ScalarValueType(ScalarValueType::TYPE_STRING)))
            ->add('templateData', new ArrayType(new ScalarValueType(ScalarValueType::TYPE_STRING)));
    }

    public function getName(): string
    {
        return self::EVENT_NAME;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param float|int|string|array|object $value
     */
    public function addData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function getContext(): Context
    {
        return $this->context;
    }

    public function getTemplateData(): array
    {
        return $this->templateData;
    }

    public function setTemplateData(array $templateData): void
    {
        $this->templateData = $templateData;
    }

    /**
     * @param float|int|string|array|object $value
     */
    public function addTemplateData(string $key, $value): void
    {
        $this->templateData[$key] = $value;
    }

    public function getLogData(): array
    {
        $data = $this->data;
        unset($data['binAttachments']);

        return [
            'data' => $data,
            'templateData' => $this->templateData,
        ];
    }

    public function getLogLevel(): int
    {
        return Logger::INFO;
    }
}
