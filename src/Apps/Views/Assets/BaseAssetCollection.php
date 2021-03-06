<?php
namespace Apps\Views\Assets;

use Cygnite\AssetManager\Asset;

/**
 * Class BaseAssetCollection.
 *
 * @package Apps\Views\Assets
 */
class BaseAssetCollection
{
    protected $asset;

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * @return Asset
     */
    public function asset() : Asset
    {
        return $this->asset;
    }

    /**
     * Register and make your Assets collection.
     *
     * @return BaseAssetCollection
     */
    public function register() : BaseAssetCollection
    {
        $this->registerStyles();
        $this->registerScripts();

        return $this;
    }

    /**
     * Register css styles into asset object.
     *
     * @return void
     */
    private function registerStyles()
    {
        // Set of resources tagged to header
        $this->asset->where('header')
            ->add('style', ['path' => 'assets/css/bootstrap/css/bootstrap.min.css'])
            ->add('style', ['path' => 'assets/css/bootstrap/css/bootstrap-theme.min.css'])
            ->add('style', ['path' => 'assets/css/cygnite/bootstrap/datatables-bootstrap.css']);
        // Set of resources tagged to footer
        $this->asset->where('footer')
            ->add('style', ['path' => 'assets/css/cygnite/flash.css'])
            ->add('style', ['path' => 'assets/css/cygnite/wysihtml5/prettify.css'])
            ->add('style', ['path' => 'assets/css/cygnite/wysihtml5/bootstrap-wysihtml5.css']);
    }

    /**
     * Register scripts into asset collection.
     *
     * @return void
     */
    private function registerScripts()
    {
        // Set of resources tagged to footer
        $this->asset->where('footer')
            ->add('script', ['path' => 'assets/js/cygnite/jquery/1.10.1/jquery.min.js'])
            ->add('script', ['path' => 'assets/js/twitter/bootstrap/js/bootstrap.min.js'])
            ->add('script', ['path' => 'assets/js/dataTables/jquery.dataTables.min.js'])
            ->add('script', ['path' => 'assets/js/dataTables/datatables-bootstrap.js'])
            ->add('script', ['path' => 'assets/js/dataTables/datatables.fnReloadAjax.js'])
            ->add('script', ['path' => 'assets/js/dataTables/prettify.js']);
    }
}