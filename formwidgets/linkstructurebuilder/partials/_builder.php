<?php if ($this->previewMode): ?>
    <div class="form-control">
        <?= e(trans('xitara.unimatrix::lang.link_pages.builder.preview', ['count' => count($value['sections'])])) ?>
    </div>
<?php else: ?>
    <div
        id="<?= $this->getId() ?>"
        class="link-structure-builder-control"
        data-control="link-structure-builder"
    >
        <textarea
            name="<?= e($name) ?>"
            id="<?= $this->getId('input') ?>"
            class="form-control hide"
            hidden
        ><?= e($valueJson) ?></textarea>

        <script type="application/json" data-builder-links><?= $availableLinksJson ?></script>
        <script type="application/json" data-builder-value><?= $valueJson ?></script>
        <script type="application/json" data-builder-texts><?= $textsJson ?></script>

        <div class="lsb" v-cloak>
            <div class="lsb-toolbar">
                <button type="button" class="btn btn-primary" @click="addSection">
                    <?= e(trans('xitara.unimatrix::lang.link_pages.builder.add_section')) ?>
                </button>
            </div>

            <div class="lsb-layout">
                <aside class="lsb-library">
                    <h4><?= e(trans('xitara.unimatrix::lang.link_pages.builder.available_links')) ?></h4>

                    <p class="help-block">
                        <?= e(trans('xitara.unimatrix::lang.link_pages.builder.available_links_comment')) ?>
                    </p>

                    <div v-if="links.length === 0" class="lsb-empty">
                        <?= e(trans('xitara.unimatrix::lang.link_pages.builder.no_links')) ?>
                    </div>

                    <div v-else class="lsb-link-grid">
                        <button
                            v-for="link in links"
                            :key="link.id"
                            type="button"
                            class="lsb-link-button"
                            :class="{ 'is-inactive': !link.is_active }"
                            draggable="true"
                            @dragstart="startLibraryDrag(link)"
                            @dragend="clearDrag"
                        >
                            <span v-if="link.icon_url" class="lsb-link-icon">
                                <img :src="link.icon_url" :alt="link.title">
                            </span>

                            <span class="lsb-link-title" v-text="link.title"></span>
                            <span v-if="!link.is_active" class="lsb-link-meta">
                                <?= e(trans('xitara.unimatrix::lang.link_pages.builder.inactive')) ?>
                            </span>
                        </button>
                    </div>
                </aside>

                <div class="lsb-sections">
                    <div v-if="structure.sections.length === 0" class="lsb-empty">
                        <?= e(trans('xitara.unimatrix::lang.link_pages.builder.empty')) ?>
                    </div>

                    <section
                        v-for="(section, sectionIndex) in structure.sections"
                        :key="section.id"
                        class="lsb-section"
                        :class="{ 'is-dragging': isDraggingSection(sectionIndex) }"
                        @dragover.prevent
                        @drop="dropSection(sectionIndex)"
                    >
                        <div class="lsb-section-header">
                            <button
                                type="button"
                                class="btn btn-default lsb-section-drag"
                                draggable="true"
                                @dragstart="startSectionDrag(sectionIndex)"
                                @dragend="clearDrag"
                                title="<?= e(trans('xitara.unimatrix::lang.link_pages.builder.move_section')) ?>"
                            >
                                <i class="icon-bars"></i>
                            </button>
                            <input
                                type="text"
                                class="form-control"
                                :placeholder="texts.sectionTitle"
                                v-model="section.title"
                                @input="syncValue"
                            >
                            <input
                                type="text"
                                class="form-control"
                                :placeholder="texts.sectionDescription"
                                v-model="section.description"
                                @input="syncValue"
                            >
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="removeSection(sectionIndex)"
                            >
                                <?= e(trans('xitara.unimatrix::lang.link_pages.builder.remove_section')) ?>
                            </button>
                        </div>

                        <div
                            class="lsb-item-grid"
                            @dragover.prevent
                            @drop="dropAtEnd(sectionIndex)"
                        >
                            <div v-if="section.items.length === 0" class="lsb-dropzone-empty">
                                <?= e(trans('xitara.unimatrix::lang.link_pages.builder.drop_here')) ?>
                            </div>

                            <div
                                v-for="(item, itemIndex) in section.items"
                                :key="item.id"
                                class="lsb-item-wrap"
                                @dragover.prevent
                                @drop.stop="dropBefore(sectionIndex, itemIndex)"
                            >
                                <button
                                    type="button"
                                    class="lsb-item-button"
                                    :class="{ 'is-missing': !findLink(item.link_id), 'is-inactive': !isLinkActive(item.link_id) }"
                                    draggable="true"
                                    @dragstart="startItemDrag(sectionIndex, itemIndex)"
                                    @dragend="clearDrag"
                                >
                                    <span v-if="findLink(item.link_id) && findLink(item.link_id).icon_url" class="lsb-link-icon">
                                        <img :src="findLink(item.link_id).icon_url" :alt="itemLabel(item)">
                                    </span>

                                    <span class="lsb-link-title" v-text="itemLabel(item)"></span>
                                </button>

                                <button
                                    type="button"
                                    class="lsb-item-remove"
                                    @click="removeItem(sectionIndex, itemIndex)"
                                >
                                    &times;
                                </button>
                            </div>
                        </div>
                    </section>

                    <div
                        v-if="structure.sections.length > 1"
                        class="lsb-section-tail-dropzone"
                        @dragover.prevent
                        @drop="dropSectionAtEnd"
                    >
                        <?= e(trans('xitara.unimatrix::lang.link_pages.builder.move_section_here')) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
