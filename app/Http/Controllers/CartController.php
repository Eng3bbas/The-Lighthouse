<?php

namespace App\Http\Controllers;

use App\Rules\ProductId;
use App\Services\CartService;
use Illuminate\Http\Request;
use function request;
class CartController extends Controller
{
    private CartService $service;
    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Darryldecode\Cart\Exceptions\UnknownModelException
     */
    public function add(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', new ProductId],
            'quantity' => ['nullable', 'integer', 'min:1']
        ]);
        $this->service->addItem(
            $request->input('id'),
            $request->input('quantity', 1)
        );
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        validator(['id' => $id],['id' => ['required','integer','min:1',new ProductId]])->validate();
        $this->service->deleteItem($id);
        return redirect('/');
    }

    public function updateQuantity($id)
    {
        validator(['id' => $id,'type' => $type = request('type','increment') ],[
            'id' => ['required','integer','min:1',new ProductId],
            'type' => ['nullable','string',function($attribute,$value,callable $fail){
                    if (!in_array($value,$types = ['increment','decrement'])){
                        $fail( "{$attribute} must be one of these types:". implode(',',$types));
                    }
            }]
        ])->validate();
        $this->service->updateQuantity($id,$type);
        return redirect('/');
    }
}
