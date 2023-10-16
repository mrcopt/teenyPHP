<?php
/**
 * Extension Autoloader
 */
require_once __DIR__ . '/Engine.php';

require_once __DIR__ . '/Extension/ExtensionInterface.php';

require_once __DIR__ . '/Template/Data.php';
require_once __DIR__ . '/Template/Directory.php';
require_once __DIR__ . '/Template/FileExtension.php';
require_once __DIR__ . '/Template/Folders.php';
require_once __DIR__ . '/Template/Func.php';
require_once __DIR__ . '/Template/Functions.php';
require_once __DIR__ . '/Template/Name.php';
require_once __DIR__ . '/Template/ResolveTemplatePath.php';
require_once __DIR__ . '/Template/Template.php';
require_once __DIR__ . '/Template/Theme.php';

require_once __DIR__ . '/Template/Folder.php';

require_once __DIR__ . '/Template/ResolveTemplatePath/NameAndFolderResolveTemplatePath.php';
require_once __DIR__ . '/Template/ResolveTemplatePath/ThemeResolveTemplatePath.php';
require_once __DIR__ . '/Exception/TemplateNotFound.php';
require_once __DIR__ . '/Extension/Asset.php';
require_once __DIR__ . '/Extension/URI.php';