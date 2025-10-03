import React from "react";
import UiHeader from "../Header/ui-Header";

export default function HomePage({ onRegisterClick, onLoginClick }) {
  return (
    <div>
      <UiHeader 
        onRegisterClick={onRegisterClick} 
        onLoginClick={onLoginClick} 
      />
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam, earum consequatur? Molestiae sapiente dolorum perferendis quia exercitationem. Ex earum cumque molestiae omnis repellendus ea. Quam dicta consequatur neque nostrum quia laboriosam quod possimus, id voluptates dignissimos hic deleniti earum at doloremque impedit, tempore voluptas! Libero in, tempora vitae totam sed dolores eligendi dignissimos suscipit laboriosam consequatur aut odio velit. Est minima provident perferendis veritatis. Autem sed sit hic cumque reprehenderit accusantium ab in ipsam enim quia aliquid placeat nihil, quas dicta cupiditate deleniti eos assumenda dolore. Officia corporis unde sed eaque exercitationem veniam laudantium, hic est, quas praesentium excepturi sunt vel a ex et adipisci? Harum sit illo expedita asperiores neque sequi repudiandae nam quibusdam exercitationem ratione accusantium, corporis in, enim at pariatur. Molestiae omnis quae, vel molestias culpa numquam consectetur porro excepturi sed laudantium atque rem aspernatur nesciunt quis eligendi. Similique deserunt facere in dicta minus doloremque perspiciatis ipsum nesciunt molestiae nulla iusto consectetur nisi accusamus, expedita enim aliquid consequuntur mollitia optio ab cum aperiam distinctio veniam libero exercitationem! Optio, accusamus? Eos odio iure nihil aliquid in, error minus magnam ducimus explicabo ex soluta illo illum, placeat est quasi quidem dolore temporibus facere quis blanditiis perspiciatis eum amet nemo.</p>
    </div>
  );
}

