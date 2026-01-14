import Item from './modules/item.js';
import Category from './modules/category.js';
import Location from './modules/location.js';
import Supplier from './modules/supplier.js';
import Report from './modules/report.js';
import Order from './modules/order.js';
import ShipBy from './modules/shipBy.js';

// Initialize all modules when the page loads
document.addEventListener('DOMContentLoaded', function() {
    Item.init();
    Category.init();
    Location.init();
    Supplier.init();
    Report.init();
    Order.init();
    ShipBy.init();
});