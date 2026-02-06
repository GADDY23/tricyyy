# Unavailable Items Demonstration

## Items Currently Marked as "Unavailable"

The system includes **8 items marked as unavailable** to demonstrate the item availability feature:

### 1. ✨ Spark Plug (Genuine Kawasaki)
- **Category:** Electrical Parts
- **Price:** ₱150
- **Status:** UNAVAILABLE (is_available = false)
- **Stock:** 0
- **Reason:** Discontinued/Out of stock
- **Display:** Red "Item Unavailable" badge
- **Action:** Cannot be added to cart

### 2. 🔧 Gasket Kit (Full Set)
- **Category:** Engine Parts
- **Price:** ₱450
- **Status:** UNAVAILABLE
- **Stock:** 0
- **Reason:** Temporarily out of stock
- **Display:** Red "Item Unavailable" badge
- **Action:** Cannot be added to cart

### 3. 🔄 Centrifugal Clutch
- **Category:** Drivetrain
- **Price:** ₱650
- **Status:** UNAVAILABLE
- **Stock:** 0
- **Reason:** Being restocked
- **Display:** Red "Item Unavailable" badge
- **Action:** Cannot be added to cart

### 4. 📊 Custom Dashboard Panel
- **Category:** Tricycle Accessories
- **Price:** ₱780
- **Status:** UNAVAILABLE
- **Stock:** 0
- **Reason:** Discontinued model
- **Display:** Red "Item Unavailable" badge
- **Action:** Cannot be added to cart

### 5. 🛑 Brake Fluid (1 Liter)
- **Category:** Brake System
- **Price:** ₱95
- **Status:** UNAVAILABLE
- **Stock:** 0
- **Reason:** Waiting for supplier
- **Display:** Red "Item Unavailable" badge
- **Action:** Cannot be added to cart

### 6. 🔧 Rear Shock Absorber
- **Category:** Suspension
- **Price:** ₱920
- **Status:** UNAVAILABLE
- **Stock:** 0
- **Reason:** Limited availability
- **Display:** Red "Item Unavailable" badge
- **Action:** Cannot be added to cart

### 7. 🛞 Inner Tube Kit (3-pack)
- **Category:** Tires & Wheels
- **Price:** ₱320
- **Status:** UNAVAILABLE
- **Stock:** 0
- **Reason:** Out of stock
- **Display:** Red "Item Unavailable" badge
- **Action:** Cannot be added to cart

### 8. 🛢️ Transmission Fluid (1L)
- **Category:** Tools & Maintenance
- **Price:** ₱220
- **Status:** UNAVAILABLE
- **Stock:** 0
- **Reason:** Waiting for shipment
- **Display:** Red "Item Unavailable" badge
- **Action:** Cannot be added to cart

---

## How the Unavailability System Works

### Customer View
When browsing the shop:
- ❌ Unavailable items show with a **red "Item Unavailable" badge**
- ❌ The **"Buy Now" button is disabled** (grayed out)
- ❌ Clicking on the item shows: **"This item is currently not available for purchase"**
- ❌ Cannot proceed to checkout with unavailable items

### Product Detail Page
For unavailable items, customers see:
```
⚠️ Item Unavailable

This item is currently not available for purchase.
```

Instead of a normal purchase button, they get:
```
[Item Unavailable] (disabled button)
```

### Shopping Cart Protection
- If a customer somehow has an unavailable item in their cart
- The system validates during checkout
- Shows error: "Not enough stock" or "Item unavailable"
- Prevents completing the purchase

### Admin Dashboard
In `/products` view, administrators can see:
- Red status indicator for unavailable items
- Shows exact availability status
- Can manage item availability from database

---

## Database Representation

In the `products` table, unavailable items have:
```sql
is_available = false
stock = 0
```

Example query:
```sql
SELECT * FROM products WHERE is_available = false;
-- Returns 8 items
```

---

## How to Manage Availability

### Mark Item as Unavailable
```sql
UPDATE products SET is_available = false WHERE id = 4;
-- Now item cannot be purchased
```

### Mark Item as Available
```sql
UPDATE products SET is_available = true WHERE id = 4;
-- Item can be purchased again
```

### Check Unavailable Items
```sql
SELECT name, price, stock FROM products WHERE is_available = false;
-- Shows all 8 currently unavailable items
```

---

## Real-World Use Cases

1. **Seasonal Items** - Mark as unavailable when out of season
2. **Discontinued Products** - Keep in catalog but mark unavailable
3. **Backorder Items** - Show coming soon but prevent purchase
4. **Limited Stock** - Can manage when stock reaches zero
5. **Supplier Issues** - Temporarily unavailable during delays
6. **Product Recalls** - Quickly disable problematic items

---

## Testing the Feature

### To Test Unavailable Items:
1. Go to `http://localhost:8000/`
2. Look for items with **red badges** saying "Item Unavailable"
3. Click on an unavailable product
4. Notice the button says "Item Unavailable" (disabled)
5. Try searching for "Spark Plug" - see it in results but can't buy
6. Try clicking "View & Buy" - shows product details but no purchase option

### To Test Available Items:
1. Browse to an item with **green badge** "In Stock"
2. Click "View & Buy"
3. See normal product page with quantity selector
4. Add to cart works normally
5. Can proceed to checkout

### To Test Low Stock:
1. Browse to items with **yellow badge** "Low Stock (3 left)"
2. Can still purchase
3. Shows warning about limited availability
4. Normal checkout process

---

## Customer Messages

### When Viewing Unavailable Item:
```
⚠️ ITEM UNAVAILABLE

This item is currently not available for purchase.

[Item Unavailable] button (disabled)
← Continue Shopping
```

### When Trying to Add to Cart:
```
⚠️ Error

This item is Item Unavailable
```

### When Checking Out:
```
✓ Cart contains all items
✓ All items are available
✓ Proceed to checkout
```

---

## Summary

The unavailability system provides:
- ✅ Clear customer communication
- ✅ Inventory management
- ✅ Prevention of overselling
- ✅ Professional appearance
- ✅ Easy to update
- ✅ Database-driven control

**Currently Demonstrating:**
- 8 unavailable items
- 29 items in stock
- 8 items with low stock warnings

All managed through the `is_available` flag in the products table!
