'use strict';

import { on } from './modules/utils';

on(document, 'DOMContentLoaded', () => {
    let message: string = 'Debugging active!';
    console.log(message);
});
