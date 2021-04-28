'use strict';

import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = [
        'container',
        'entry'
    ];

    static values = {
        allowAdd: Boolean,
        allowDelete: Boolean,
        buttonAddClass: String,
        buttonAddText: String,
        buttonDeleteClass: String,
        buttonDeleteText: String,
    };

    /**
     * Number of elements for the index of the collection
     * @type Number
     */
    index = 0;

    /**
     * Controller name of this
     * @type String|null
     */
    controllerName = null;

    connect() {

        this.controllerName = this.context.scope.identifier;

        this._dispatchEvent('collection:pre-connect', {
            allowAdd: this.allowAddValue,
            allowDelete: this.allowDeleteValue,
        });

        if (true === this.allowAddValue) {
            // Add button Add
            let buttonAdd = this._textToNode('<button data-action="' + this.controllerName + '#add"'
                + ' class="' + this.buttonAddClassValue + '" type="button">'
                + this.buttonAddTextValue + '</button>');
            this.containerTarget.prepend(buttonAdd);
        }

        // Add buttons Delete
        if (true === this.allowDeleteValue) {
            for (let i = 0; i < this.entryTargets.length; i++) {
                this.index = i;
                let entry = this.entryTargets[i];
                this._addDeleteButton(entry, this.index);
            }
        }

        this._dispatchEvent('collection:connect', {
            allowAdd: this.allowAddValue,
            allowDelete: this.allowDeleteValue,
        });
    }

    add(event) {

        this.index++;

        // Compute the new entry
        let newEntry = this.containerTarget.dataset.prototype;
        newEntry = newEntry.replace(/__name__label__/g, this.index);
        newEntry = newEntry.replace(/__name__/g, this.index);

        newEntry = this._textToNode(newEntry);
        newEntry = this._addDeleteButton(newEntry, this.index);

        this._dispatchEvent('collection:pre-add', {
            index: this.index,
            element: newEntry
        });

        this.containerTarget.append(newEntry);
    }

    delete(event) {

        let theIndexEntryToDelete = event.target.dataset.indexEntry;

        // Search the entry to delete from the data-index-entry attribute
        for (let i = 0; i < this.entryTargets.length; i++) {
            let entry = this.entryTargets[i];
            if (theIndexEntryToDelete === entry.dataset.indexEntry) {

                this._dispatchEvent('collection:pre-delete', {
                    index: entry.dataset.indexEntry,
                    element: entry
                });

                entry.remove();

                this._dispatchEvent('collection:delete', {
                    index: entry.dataset.indexEntry,
                    element: entry
                });
            }
        }
    }

    /**
     * Add the delete button to the entry
     * @param String entry
     * @param Number index
     * @returns {ChildNode}
     * @private
     */
    _addDeleteButton(entry, index) {

        // link the button and the entry by the data-index-entry attribute
        entry.dataset.indexEntry = index;

        let buttonDelete = this._textToNode('<button data-action="' + this.controllerName + '#delete"'
            + ' data-index-entry="' + index + '" class="' + this.buttonDeleteClassValue + '" type="button">'
            + this.buttonDeleteTextValue + '</button>');
        entry.append(buttonDelete);

        return entry;
    }

    /**
     * Convert text to Element to insert in the DOM
     * @param String text
     * @returns {ChildNode}
     * @private
     */
    _textToNode(text) {

        let div = document.createElement('div');
        div.innerHTML = text.trim();

        return div.firstChild;
    }

    _dispatchEvent(name, payload = null, canBubble = false, cancelable = false) {
        const userEvent = document.createEvent('CustomEvent');
        userEvent.initCustomEvent(name, canBubble, cancelable, payload);

        this.element.dispatchEvent(userEvent);
    }
}
