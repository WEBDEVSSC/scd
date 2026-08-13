import './bootstrap';

import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Registrar plugins
FilePond.registerPlugin(FilePondPluginImagePreview);

// Exportar globalmente para usarlo en vistas Blade
window.FilePond = FilePond;