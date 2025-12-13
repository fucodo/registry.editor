<?php
namespace fucodo\registry\editor\Controller;

use fucodo\registry\Domain\Repository\RegistryEntryRepository;
use fucodo\registry\editor\Domain\Dto\EntryDto;
use KayStrobach\Backend\Controller\AbstractPageRendererController;
use Neos\Flow\Annotations as Flow;

class EditorController extends AbstractPageRendererController
{
    /**
     * @Flow\InjectConfiguration(package="fucodo.registry", path="defaults")
     * @var array
     */
    protected ?array $options;

    /**
     * @Flow\Inject
     * @var RegistryEntryRepository
     */
    protected RegistryEntryRepository $registryEntryRepository;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('items', $this->options);
    }

    public function editAction(EntryDto $dto)
    {
        $dto->setValue($this->registryEntryRepository->get($dto->namespace, $dto->name)?->getValue());
        $this->view->assign('dto', $dto);

    }

    public function updateSettingAction(EntryDto $dto)
    {
        $this->registryEntryRepository->set(
            $dto->namespace,
            $dto->name,
            $dto->value
        );
        $this->redirect(
            'edit',
            null,
            null,
            [
                'dto' => $dto->jsonSerialize()
            ]
        );
    }
}
