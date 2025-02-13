<?php
    $listElementId = $this->getId('item-list');
?>

<ul class="media-list <?= $listClass ?>">
    <?php if (count($items) > 0 || !$isRootFolder): ?>
        <?php if (!$isRootFolder && !$searchMode): ?>
            <li tabindex="0" data-type="media-item" data-item-type="folder" data-root data-path="<?= e(dirname($currentFolder)) ?>">
                <div class="icon-container folder">
                    <div class="icon-wrapper"><i class="icon-arrow-turn-up"></i></div>
                </div>
                <div class="info">
                    <h4 title="<?= e(trans('backend::lang.media.return_to_parent')) ?>"><?= e(trans('backend::lang.media.return_to_parent_label')) ?></h4>
                </div>
            </li>
        <?php endif ?>

        <?php foreach ($items as $item): ?>
            <?php
                $itemType = $item->getFileType();
            ?>
            <li data-type="media-item"
                data-item-type="<?= $item->type ?>"
                data-path="<?= e($item->path) ?>"
                data-title="<?= e(basename($item->path)) ?>"
                data-size="<?= e($item->sizeToString()) ?>"
                data-last-modified="<?= e($item->lastModifiedAsString()) ?>"
                data-last-modified-ts="<?= $item->lastModified ?>"
                data-public-url="<?= e($item->publicUrl) ?>"
                data-document-type="<?= e($itemType) ?>"
                data-folder="<?= e(dirname($item->path)) ?>"
                tabindex="0"
            >
                <?= $this->makePartial('item-icon', ['itemType'=>$itemType, 'item'=>$item]) ?>

                <div class="info">
                    <h4 title="<?= e(basename($item->path)) ?>">
                        <?= e(basename($item->path)) ?>

                        <?php if (!$this->readOnly): ?>
                            <a
                                href="#"
                                data-rename
                                data-control="popup"
                                data-z-index="1200"
                                data-request-data="path: '<?= e($item->path) ?>', listId: '<?= $listElementId ?>', type: '<?= $item->type ?>'"
                                data-handler="<?= $this->getEventHandler('onLoadRenamePopup') ?>"
                            ><i data-rename-control class="icon-terminal"></i></a>
                        <?php endif; ?>
                    </h4>
                    <p class="size"><?= e($item->sizeToString()) ?></p>
                </div>
            </li>
        <?php endforeach ?>
    <?php endif ?>

    <?php if (count($items) == 0 && $searchMode): ?>
        <li class="no-data">
            <?= e(trans('backend::lang.media.no_files_found')) ?>
        </li>
    <?php endif ?>
</ul>
