<?php
namespace Ahromets\Testimonials\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * Post factory
     *
     * @var \Ahromets\Testimonials\Model\TestimonialFactory
     */
    protected $_testimonialFactory;

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Ahromets\Testimonials\Model\TestimonialFactory $testimonialFactory
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Ahromets\Testimonials\Model\TestimonialFactory $testimonialFactory
    ) {
        $this->actionFactory = $actionFactory;
        $this->_testimonialFactory = $testimonialFactory;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $url_key = trim($request->getPathInfo(), '/testimonial/');
        $url_key = rtrim($url_key, '/');


        /** @var \Ahromets\Testimonials\Model\Testimonial $testimonial */
        $testimonial = $this->_testimonialFactory->create();
        $testimonial_id = $testimonial->getById($url_key);
        if (!$testimonial_id) {
            return null;
        }

        $request->setModuleName('testimonials')->setControllerName('view')->setActionName('index')->setParam('testimonial_id', $testimonial_id);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $url_key);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }

}