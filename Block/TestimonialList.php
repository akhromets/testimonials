<?php
namespace Ahromets\Testimonials\Block;

use Ahromets\Testimonials\Api\Data\TestimonialInterface;
use Ahromets\Testimonials\Model\ResourceModel\Testimonial\Collection as TestimonialCollection;

class TestimonialList extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * @var \Ahromets\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory
     */
    protected $_testimonialCollectionFactory;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Ahromets\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory $testimonialCollectionFactory ,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ahromets\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory $testimonialCollectionFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_testimonialCollectionFactory = $testimonialCollectionFactory;
    }

    /**
     * @return \Ahromets\Testimonials\Model\ResourceModel\Testimonial\Collection
     */
    public function getTestimonials()
    {

        if (!$this->hasData('testimonials')) {
            $testimonials = $this->_testimonialCollectionFactory
                ->create()
                ->addFilter('is_active', 1)
                ->addOrder(
                    TestimonialInterface::CREATION_TIME,
                    TestimonialCollection::SORT_ORDER_DESC
                );
            $this->setData('testimonials', $testimonials);
        }
        return $this->getData('testimonials');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Ahromets\Testimonials\Model\Testimonial::CACHE_TAG . '_' . 'list'];
    }

    public function isAuthorized()
    {
        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $session = $om->get('Magento\Framework\App\Http\Context');
        $isLoggedIn = $session->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return $isLoggedIn;
    }
}